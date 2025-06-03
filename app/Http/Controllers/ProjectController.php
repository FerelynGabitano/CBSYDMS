<?php

// This file is part of the Surigao Youth Development Project.
// (c) Batang Surigaonon Youth.

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
                'image' => '1.jpg',
                'folder' => 'Basic_Life_Support_Training',
                'gallery_images' => [
                    '1.jpg',
                    '2.jpg',    
                    '3.jpg',
                    '4.jpg',
                    '5.jpg',
                    '6.jpg',
                ],
            ],
            2 => [
                'id' => 2,
                'title' => 'Youth Leadership Summit',
                'description' => 'An annual summit to inspire and train young leaders in Surigao for community development.',
                'image' => '1.jpg',
                'folder' => 'Community_Clean_Up',
                'gallery_images' => [
                    '1.jpg',
                    '2.jpg',
                    '3.jpg',
                    '4.jpg',
                    '5.jpg',
                    '6.jpg',
                ],
            ],
            3 => [
                'id' => 3,
                'title' => 'Scholarship Drive',
                'description' => 'Supporting education by providing scholarships to underprivileged students in the region.',
                'image' => '1.jpg',
                'folder' => 'Feeding_Program',
                'gallery_images' => [
                    '1.jpg',
                    '2.jpg',
                    '3.jpg',
                    '4.jpg',
                    '5.jpg',
                    '6.jpg',
                ],
            ],
            4 =>  [
                'id' => 4,
                'title' => 'Cultural Festival',
                'description' => 'Celebrating Surigaonon culture through art, music, and dance performances by the youth.',
                'image' => '1.jpg',
                'folder' => 'Free_IceCream&Sim_Reg',
                'gallery_images' => [
                    '1.jpg',
                    '2.jpg',
                    '3.jpg',
                    '4.jpg',
                    '5.jpg',
                    '6.jpg',

                ],
            ],
            5 =>  [
                'id' => 5,
                'title' => 'Tree Planting Event',
                'description' => 'Planting trees to contribute to a greener Surigao community.',
                'image' => '1.jpg',
                'folder' => 'Relief_Operations',
                'gallery_images' => [
                    '1.jpg',
                    '2.jpg',
                    '3.jpg',
                    '4.jpg',
                    '5.jpg',
                    '6.jpg',
                ],
            ]
        ];

        // Fetch the project by ID, or return a default/fallback if not found
        // $project = [
        //     'id' => $id,
        //     'project' => $projects,
        //     'title' => 'Project Not Found',
        //     'description' => 'The project you are looking for does not exist.',
        //     'image' => 'default.jpg'
        // ];

        return view('project-details', compact('project', 'id'));
    }
}

