<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $project->title }} - Project Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #fff;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 40px 20px;
            text-align: center;
        }

        h1 {
            color: #FFA500;
            /* Orange heading */
            font-size: 1.5em;
            text-transform: uppercase;
            margin-bottom: 20px;
        }

        h2 {
            color: #6A0DAD;
            /* Purple subheading */
            font-size: 1.2em;
            margin: 20px 0 10px;
        }

        p {
            color: #666;
            font-size: 1em;
            line-height: 1.6;
            margin: 0 0 15px;
            text-align: left;
        }

        .image-container img {
            width: 100%;
            max-width: 600px;
            height: auto;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .section {
            text-align: left;
            padding: 15px;
            background-color: #f9f9f9;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        @media (max-width: 768px) {
            h1 {
                font-size: 1.2em;
            }

            h2 {
                font-size: 1em;
            }

            p {
                font-size: 0.9em;
            }

            .image-container img {
                max-width: 100%;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>{{ $project->title }}</h1>
        <div class="image-container">
            <img src="{{ asset('assets/images/' . $project->image) }}" alt="{{ $project->title }}">
        </div>
        <div class="section">
            <h2>Overview</h2>
            <p>{{ $project->description }}</p>
        </div>
        <div class="section">
            <h2>Goals</h2>
            <p>This project aims to achieve sustainable outcomes, such as environmental preservation, community
                engagement, or educational support. Specific goals will be detailed as the project progresses.</p>
        </div>
        <div class="section">
            <h2>Timeline</h2>
            <p>Planned start: June 2025. Estimated completion: December 2025. Updates will be provided as milestones are
                reached.</p>
        </div>
        <div class="section">
            <h2>Additional Notes</h2>
            <p>This is a temporary placeholder page. Replace this content with the actual project documentation,
                including team members, resources, and progress updates.</p>
        </div>
    </div>
</body>

</html>