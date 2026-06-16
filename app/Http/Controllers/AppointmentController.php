<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller {
    // KONSULI
   
    public function showBookingForm($konselor_id) {
        $konselor = User::findOrFail($konselor_id);
        return view('konsuli.booking', compact('konselor'));
    }

    public function storeBooking(Request $request) {

        $request->validate([
            'konselor_id' => 'required|exists:users,id',
            'tanggal_temu' => 'required|date|after:today',
            'keluhan' => 'required|string'
        ]);

        Appointment::create([
            'konsuli_id' => Auth::id(),
            'konselor_id' => $request->konselor_id,
            'tanggal_temu' => $request->tanggal_temu,
            'keluhan' => $request->keluhan,
            'status' => 'pending'
        ]);

        return redirect()->route('konsuli.dashboard')->with('success', 'Janji temu berhasil dibuat!');
    }
        public function updateStatus($id, $status) {
            $appointment = Appointment::findOrFail($id);
            if (in_array($status, ['accepted', 'rejected'])) {
                $appointment->status = $status;
                $appointment->save();
            }
            return redirect()->route('konselor.dashboard')->with('success', 'Status janji temu berhasil diperbarui!');
        }

        public function destroyBooking($id) {
          $appointment = Appointment::findOrFail($id);
          $appointment->delete();
          return redirect()->route('konsuli.dashboard')->with('success', 'Pengajuan berhasil dibatalkan/dihapus.');
}

    // KONSELOR
    public function konselorDashboard() {
        $appointments = Appointment::where('konselor_id', Auth::id())->with('konsuli')->get();
        return view('konselor.dashboard', compact('appointments'));
    }

    public function konsuliDashboard() {
        $konselor = User::where('role', 'konselor')->get();
        
        $riwayat_booking = Appointment::where('konsuli_id', Auth::id())->with('konselor')->get();

        return view('konsuli.dashboard', compact('konselor', 'riwayat_booking'));
    }
}