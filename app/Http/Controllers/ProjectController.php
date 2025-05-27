<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function show($id)
    {
    $projects = [
            1 => (object) [
                'id' => 1,
                'title' => 'Community Clean-Up',
                'description' => 'A project to clean and preserve Surigao\'s beaches, promoting environmental awareness among the youth.',
                'image' => 'project1.jpg'
            ],
            2 => (object) [
                'id' => 2,
                'title' => 'Youth Leadership Summit',
                'description' => 'An annual summit to inspire and train young leaders in Surigao for community development.',
                'image' => 'project2.jpg'
            ],
            3 => (object) [
                'id' => 3,
                'title' => 'Scholarship Drive',
                'description' => 'Supporting education by providing scholarships to underprivileged students in the region.',
                'image' => 'project3.jpg'
            ],
            4 => (object) [
                'id' => 4,
                'title' => 'Cultural Festival',
                'description' => 'Celebrating Surigaonon culture through art, music, and dance performances by the youth.',
                'image' => 'project4.jpg'
            ],
            5 => (object) [
                'id' => 5,
                'title' => 'Tree Planting Event',
                'description' => 'Planting trees to contribute to a greener Surigao community.',
                'image' => 'project5.jpg'
            ]
        ];

        // Fetch the project by ID, or return a default/fallback if not found
        $project = isset($projects[$id]) ? $projects[$id] : (object) [
            'id' => $id,
            'title' => 'Project Not Found',
            'description' => 'The project you are looking for does not exist.',
            'image' => 'default.jpg'
        ];

        return view('project-details', compact('project'));
    }
}
