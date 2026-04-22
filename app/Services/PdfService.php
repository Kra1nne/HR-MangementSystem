<?php
namespace App\Services;
use TCPDF;

class PdfService
{
    private array $colors = [
        'primary'    => [30, 30, 30],
        'secondary'  => [100, 100, 100],
        'border'     => [220, 220, 216],
        'header_bg'  => [248, 248, 246],
        'in_bg'      => [234, 243, 222],
        'in_text'    => [59, 109, 17],
        'out_bg'     => [250, 236, 231],
        'out_text'   => [153, 60, 29],
        'badge_bg'   => [230, 241, 251],
        'badge_text' => [24, 95, 165],
    ];

    public function generate($data, $info)
    {
        $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

        $pdf->SetCreator('Laravel App');
        $pdf->SetAuthor('Laravel App');
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->SetMargins(16, 16, 16);
        $pdf->SetAutoPageBreak(false);
        $pdf->AddPage();
        $pdf->SetFont('helvetica', '', 10);
        
        $this->drawMeta($pdf, $info);
        $this->drawTable($pdf, $data);
        $this->drawFooter($pdf, $data);

        return response($pdf->Output('invoice.pdf', 'I'))
            ->header('Content-Type', 'application/pdf');
    }

    private function drawMeta(TCPDF $pdf, $info): void
    {
        $pageW  = $pdf->getPageWidth() - 32;
        $startY = $pdf->GetY() + 1;

        $pdf->SetFillColor(...$this->colors['header_bg']);
        $pdf->SetDrawColor(...$this->colors['border']);
        $pdf->RoundedRect(16, $startY, $pageW, 16, 2, '1111', 'FD');

        $fields = $info;

        $colW = $pageW / count($fields);

        foreach ($fields as $i => [$label, $value]) {
            $x = 16 + $i * $colW + 4;

            $pdf->SetXY($x, $startY + 2.5);
            $pdf->SetFont('helvetica', 'B', 7);
            $pdf->SetTextColor(...$this->colors['secondary']);
            $pdf->Cell($colW - 8, 4, strtoupper($label), 0, 1, 'L');

            $pdf->SetXY($x, $startY + 7);
            $pdf->SetFont('helvetica', 'B', 9);
            $pdf->SetTextColor(...$this->colors['primary']);
            $pdf->Cell($colW - 8, 5, $value, 0, 1, 'L');
        }

        $pdf->SetY($startY + 16 + 2);
    }

    private function drawTableHeader(TCPDF $pdf, array $cols, array $headers): void
    {
        $pdf->SetFillColor(...$this->colors['header_bg']);
        $pdf->SetDrawColor(...$this->colors['border']);
        $pdf->SetFont('helvetica', 'B', 8);
        $pdf->SetTextColor(...$this->colors['secondary']);

        foreach ($headers as $i => $h) {
            $align = $i === 0 ? 'L' : 'C';
            $pdf->Cell($cols[$i], 8, $h, 'LTB', 0, $align, true);
        }
        $pdf->Cell(0, 8, '', 'RB', 1);
    }

    private function drawTable(TCPDF $pdf, $data): void
    {
        $pageW   = $pdf->getPageWidth() - 32;
        $pageH   = $pdf->getPageHeight() - 22;
        $colDay  = 28;
        $colTime = ($pageW - $colDay) / 4;
        $cols    = [$colDay, $colTime, $colTime, $colTime, $colTime];
        $rowH    = 9;
        $x0      = 16;
        $rowIdx  = 0;

        $headers = [' ', 'Time In', 'Time Out', 'Time In', 'Time Out'];

        $this->drawTableHeader($pdf, $cols, $headers);

        foreach ($data as $day => $logs) {
            // Collect up to 4 time slots
            $slots = ['', '', '', ''];
            if ($logs instanceof \Illuminate\Support\Collection) {
                foreach ($logs->take(4)->values() as $i => $log) {
                    $slots[$i] = $log->time ?? '';
                }
            }

            $y = $pdf->GetY();

            // Manual page break
            if ($y + $rowH > $pageH) {
                $pdf->AddPage();
                $pdf->SetY(16);
                $y = $pdf->GetY();
                $this->drawTableHeader($pdf, $cols, $headers);
                $y = $pdf->GetY();
            }

            // Alternating row background
            $pdf->SetFillColor(...($rowIdx % 2 === 0 ? [255, 255, 255] : [250, 250, 249]));
            $rowIdx++;

            $pdf->SetDrawColor(...$this->colors['border']);
            $pdf->Rect($x0, $y, $pageW, $rowH, 'FD');

            // Day pill
            $pdf->SetFillColor(240, 240, 238);
            $pdf->SetDrawColor(...$this->colors['border']);
            $pdf->RoundedRect($x0 + 2, $y + 1.5, 24, 6, 1.5, '1111', 'FD');
            $pdf->SetXY($x0 + 2, $y + 1.8);
            $pdf->SetFont('helvetica', 'B', 7.5);
            $pdf->SetTextColor(...$this->colors['primary']);
            $pdf->Cell(24, 5.5, is_numeric($day) ? 'Day ' . $day : $day, 0, 0, 'C');

            // Time slot pills
            foreach ($slots as $idx => $slot) {
                $cellX = $x0 + $colDay + $idx * $colTime;

                if ($slot) {
                    $formatted = date('h:i A', strtotime($slot));
                    $isIn      = $idx % 2 === 0;

                    [$bg, $fg] = $isIn
                        ? [$this->colors['in_bg'],  $this->colors['in_text']]
                        : [$this->colors['out_bg'], $this->colors['out_text']];

                    $pdf->SetFillColor(...$bg);
                    $pdf->SetDrawColor(...$fg);
                    $pdf->RoundedRect($cellX + 3, $y + 1.5, $colTime - 6, 6, 1.5, '1111', 'FD');
                    $pdf->SetXY($cellX + 3, $y + 2);
                    $pdf->SetFont('helvetica', 'B', 7.5);
                    $pdf->SetTextColor(...$fg);
                    $pdf->Cell($colTime - 6, 5, $formatted, 0, 0, 'C');
                } else {
                    $pdf->SetXY($cellX, $y + 1.5);
                    $pdf->SetFont('helvetica', '', 9);
                    $pdf->SetTextColor(...$this->colors['border']);
                    $pdf->Cell($colTime, 6, '—', 0, 0, 'C');
                }
            }

            $pdf->SetY($y + $rowH);
        }
    }

    private function drawFooter(TCPDF $pdf, $data): void
    {
        $pageW = $pdf->getPageWidth() - 32;
        $y     = $pdf->GetY() + 1;
        $count = is_countable($data) ? count($data) : 0;

        // Check if footer fits on current page, else new page
        if ($y + 14 > $pdf->getPageHeight() - 10) {
            $pdf->AddPage();
            $y = 16;
        }

        $pdf->SetFillColor(...$this->colors['header_bg']);
        $pdf->SetDrawColor(...$this->colors['border']);
        $pdf->RoundedRect(16, $y, $pageW, 12, 2, '0110', 'FD');

        // Left note
        $pdf->SetXY(22, $y + 3.5);
        $pdf->SetFont('helvetica', '', 8);
        $pdf->SetTextColor(...$this->colors['secondary']);
        $pdf->Cell(0, 5, 'Generated by VoxSync', 0, 0, 'L');

        // Right count badge
        $badgeW = 32;
        $badgeX = 16 + $pageW - $badgeW - 2;
        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetDrawColor(...$this->colors['border']);
        $pdf->RoundedRect($badgeX, $y + 2.5, $badgeW, 7, 1.5, '1111', 'FD');
        $pdf->SetXY($badgeX, $y + 3.5);
        $pdf->SetFont('helvetica', 'B', 8);
        $pdf->SetTextColor(...$this->colors['secondary']);
        $pdf->Cell($badgeW, 5, $count . ' days logged', 0, 0, 'C');
    }
}