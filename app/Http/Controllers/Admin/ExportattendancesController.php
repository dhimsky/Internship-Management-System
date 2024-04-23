<?php

namespace App\Http\Controllers\Admin;

use App\Attendance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Dompdf\Dompdf;
use Dompdf\Options;
use Carbon\Carbon;

class ExportattendancesController extends Controller
{
    public function downloadAttendancesPDF(Request $request)
    {
        $date = $request->input('date');

        if ($date) {
            // Jika tanggal disediakan, filter data berdasarkan tanggal
            $attendances = Attendance::whereDate('created_at', Carbon::createFromFormat('Y-m-d', $date))->get();
        } else {
            // Jika tanggal tidak disediakan, ambil semua data attendance
            $attendances = Attendance::all();
        }

        // Load the HTML view
        $html = view('admin.employees.exportattendances', compact('attendances','date'));

        // Create Dompdf instance
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $pdf = new Dompdf($options);

        // Load HTML content
        $pdf->loadHtml($html);

        // Render PDF (optional settings)
        $pdf->setPaper('A4', 'portrait');

        // Output the generated PDF to the browser
        $pdf->render();
        return $pdf->stream('attendance.pdf');
    }
}