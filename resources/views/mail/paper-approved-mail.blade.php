<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Paper</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-size: cover;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            background: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            background-color: #f7941d;
            color: #ffffff;
            text-align: center;
            padding: 15px;
            font-size: 20px;
            font-weight: bold;
            border-radius: 8px 8px 0 0;
        }

        .content {
            padding: 20px;
            line-height: 1.6;
            color: #333333;
        }

        .footer {
            text-align: center;
            padding: 10px;
            font-size: 12px;
            color: #777777;
            border-top: 1px solid #dddddd;
            margin-top: 20px;
        }

        .btn {
            display: inline-block;
            background-color: #f7941d;
            color: #ffffff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="container">

        <div class="header">
            <p>Conference Management System</p>
        </div>

        <div class="content">
            <p>Dear {{ $authorName }},</p>

            <p>We are pleased to inform you that your paper has been reviewed, and it has been moved forward in the
                approval process. 🎉</p>

            <p><strong>Paper Code:</strong> {{ $paperCode }}</p>
            <p><strong>conference Name:</strong> {{ $conferenceName }}</p>

            <p>At this stage, no further action is required from you. However, if any additional updates or
                clarifications are needed, we will contact you.</p>

            <p>Thank you for your contribution!</p>
        </div>

        <div class="footer">
            &copy; {{ date('Y') }} Conference Management System. All Rights Reserved.
        </div>

    </div>

</body>

</html>