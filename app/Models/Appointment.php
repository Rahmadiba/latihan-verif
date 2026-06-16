<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model {
    use HasFactory;

       protected $fillable = ['konsuli_id', 'konselor_id', 'tanggal_temu', 'keluhan', 'status'];

    public function konsuli() {
        return $this->belongsTo(User::class, 'konsuli_id');
    }

    public function konselor() {
        return $this->belongsTo(User::class, 'konselor_id');
    }

    public function konsuliDashboard() {
   
    $konselor = User::where('role', 'konselor')->get();
    
    $riwayat_booking = Appointment::where('konsuli_id', Auth::id())->with('konselor')->get();


    return view('konsuli.dashboard', compact('konselor', 'riwayat_booking'));
}
}