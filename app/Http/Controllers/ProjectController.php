<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function show($id)
    {
        $project = [
            1 => [
                'id' => 1,
                'title' => 'Basic Life Support Training',
                'description' => 'A project to clean and preserve Surigao\'s beaches, promoting environmental awareness among the youth.',
                'folder' => 'Basic_Life_Support_Training',
                'gallery_images' => ['1.jpg', '2.jpg', '3.jpg', '4.jpg', '5.jpg', '6.jpg'],
            ],
            2 => [
                'id' => 2,
                'title' => 'Youth Leadership Summit',
                'description' => 'An annual summit to inspire and train young leaders in Surigao for community development.',
                'folder' => 'Community_Clean_Up',
                'gallery_images' => ['1.jpg', '2.jpg', '3.jpg', '4.jpg', '5.jpg', '6.jpg'],
            ],
            3 => [
                'id' => 3,
                'title' => 'Scholarship Drive',
                'description' => 'Supporting education by providing scholarships to underprivileged students in the region.',
                'folder' => 'Feeding_Program',
                'gallery_images' => ['1.jpg', '2.jpg', '3.jpg', '4.jpg', '5.jpg', '6.jpg'],
            ],
            4 => [
                'id' => 4,
                'title' => 'Cultural Festival',
                'description' => 'Celebrating Surigaonon culture through art, music, and dance performances by the youth.',
                'folder' => 'Free_IceCream&Sim_Reg',
                'gallery_images' => ['1.jpg', '2.jpg', '3.jpg', '4.jpg', '5.jpg', '6.jpg'],
            ],
            5 => [
                'id' => 5,
                'title' => 'Tree Planting Event',
                'description' => 'Planting trees to contribute to a greener Surigao community.',
                'folder' => 'Relief_Operations',
                'gallery_images' => ['1.jpg', '2.jpg', '3.jpg', '4.jpg', '5.jpg', '6.jpg'],
            ]
        ];

        // Validate $id and provide a default if not found
        if (!array_key_exists($id, $project)) {
            $projectData = $project[1]; // Default to project 1
            $id = 1;
        } else {
            $projectData = $project[$id];
        }

        return view('project-details', compact('projectData', 'id'));
    }
}
