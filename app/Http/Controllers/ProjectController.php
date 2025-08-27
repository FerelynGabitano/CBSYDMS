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
                'title' => 'Community Clean-Up',
                'description' => 'Organizing volunteers to clean and maintain Surigao\'s beaches, fostering environmental stewardship and community pride among the youth.',
                'folder' => 'Basic_Life_Support_Training',
                'gallery_images' => ['1.jpg', '2.jpg', '3.jpg', '4.jpg', '5.jpg', '6.jpg'],
            ],
            2 => [
                'id' => 2,
                'title' => 'Basic Life Support Training',
                'description' => 'Providing hands-on training in CPR and first aid to empower Surigao\'s youth with life-saving skills.',
                'folder' => 'Community_Clean_Up',
                'gallery_images' => ['1.jpg', '2.jpg', '3.jpg', '4.jpg', '5.jpg', '6.jpg'],
            ],
            3 => [
                'id' => 3,
                'title' => 'Feeding Programs',
                'description' => 'Distributing nutritious meals to underprivileged children in Surigao to support their health and education.',
                'folder' => 'Feeding_Program',
                'gallery_images' => ['1.jpg', '2.jpg', '3.jpg', '4.jpg', '5.jpg', '6.jpg'],
            ],
            4 => [
                'id' => 4,
                'title' => 'Free Ice Cream & Sim Registration',
                'description' => 'Hosting a fun community event with free ice cream and SIM card registration to promote connectivity and joy among Surigaonons.',
                'folder' => 'Free_IceCream&Sim_Reg',
                'gallery_images' => ['1.jpg', '2.jpg', '3.jpg', '4.jpg', '5.jpg', '6.jpg'],
            ],
            5 => [
                'id' => 5,
                'title' => 'Relief Operations',
                'description' => 'Delivering essential supplies and support to Surigao communities affected by natural disasters.',
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
