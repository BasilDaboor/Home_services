<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Contact Form Submission</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            background: #6366f1;
            color: white;
            padding: 20px;
            text-align: center;
        }

        .content {
            background: #f8fafc;
            padding: 20px;
        }

        .field {
            margin-bottom: 15px;
        }

        .label {
            font-weight: bold;
            color: #4f46e5;
        }

        .value {
            margin-top: 5px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>New Contact Form Submission</h1>
        </div>

        <div class="content">
            <div class="field">
                <div class="label">Name:</div>
                <div class="value">{{ $data['first_name'] }} {{ $data['last_name'] }}</div>
            </div>

            <div class="field">
                <div class="label">Email:</div>
                <div class="value">{{ $data['email'] }}</div>
            </div>

            @if (!empty($data['phone_number']))
                <div class="field">
                    <div class="label">Phone:</div>
                    <div class="value">{{ $data['phone_number'] }}</div>
                </div>
            @endif

            <div class="field">
                <div class="label">Subject:</div>
                <div class="value">
                    @switch($data['subject'])
                        @case('provider_application')
                            Provider Application
                        @break

                        @case('report_problem')
                            Report a Problem
                        @break

                        @case('general_message')
                            General Message
                        @break

                        @default
                            {{ $data['subject'] }}
                    @endswitch
                </div>
            </div>

            <div class="field">
                <div class="label">Message:</div>
                <div class="value">{!! nl2br(e($data['message'])) !!}</div>
            </div>

            <div class="field">
                <div class="label">Submitted:</div>
                <div class="value">{{ now()->format('M j, Y \a\t g:i A') }}</div>
            </div>
        </div>
    </div>
</body>

</html>
