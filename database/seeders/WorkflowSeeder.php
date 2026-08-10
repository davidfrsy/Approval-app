<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\WorkRequest;
use App\Models\RequestHistory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WorkflowSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        $requester = User::create([
            'name' => 'Requester User',
            'email' => 'requester@example.com',
            'password' => bcrypt('password'),
            'role' => 'requester',
        ]);

        $supervisor = User::create([
            'name' => 'Supervisor User',
            'email' => 'supervisor@example.com',
            'password' => bcrypt('password'),
            'role' => 'supervisor',
        ]);

        $technician = User::create([
            'name' => 'Technician User',
            'email' => 'technician@example.com',
            'password' => bcrypt('password'),
            'role' => 'technician',
        ]);

        $workRequest = WorkRequest::create([
            'requester_id' => $requester->id,
            'assigned_to' => $technician->id,
            'approved_by' => $supervisor->id,
            'title' => 'Printer Lab Tidak Bisa Digunakan',
            'description' => 'Printer di area lab tidak dapat melakukan printing.',
            'priority' => 'high',
            'status' => 'approved',
            'submitted_at' => now(),
            'approved_at' => now(),
        ]);

        RequestHistory::create([
            'work_request_id' => $workRequest->id,
            'user_id' => $requester->id,
            'action' => 'submitted',
            'from_status' => 'draft',
            'to_status' => 'pending_approval',
        ]);

        RequestHistory::create([
            'work_request_id' => $workRequest->id,
            'user_id' => $supervisor->id,
            'action' => 'approved',
            'from_status' => 'pending_approval',
            'to_status' => 'approved',
        ]);
    }
}
