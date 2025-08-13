<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Phản hồi từ Admin</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 30px auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            border: 1px solid #ddd;
        }
        .header {
            background-color: #007bff;
            color: #fff;
            padding: 15px 20px;
            font-size: 18px;
            font-weight: bold;
        }
        .content {
            padding: 20px;
        }
        .content p {
            line-height: 1.6;
        }
        .blockquote {
            border-left: 4px solid #007bff;
            padding-left: 10px;
            margin: 10px 0;
            color: #555;
        }
        .admin-note {
            padding: 10px;
            border: 1px solid #ccc;
            background-color: #f9f9f9;
            margin: 10px 0;
            border-radius: 4px;
        }
        .footer {
            padding: 15px 20px;
            font-size: 14px;
            color: #777;
            text-align: center;
            background-color: #f4f4f4;
        }
        .rating i {
            color: #ffc107;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            Phản hồi từ Admin
        </div>
        <div class="content">
            <p>Xin chào <strong>{{ $data->name }}</strong>,</p>

            <p>Chúng tôi đã nhận được góp ý của bạn với nội dung:</p>
            <div class="blockquote">{{ $data->message }}</div>

            <p>Công ty chúng tôi xin được phản hồi cho bạn như sau:</p>
            <div class="admin-note">{{ $data->admin_note }}</div>

            <p>Trạng thái hiện tại của góp ý: 
                @if($data->status === 'responded')
                    <strong>Đã phản hồi</strong>
                @elseif($data->status === 'pending')
                    <strong>Chưa xử lý</strong>
                @elseif($data->status === 'hidden')
                    <strong>Spam</strong>
                @endif
            </p>

            @if(!empty($data->rating))
            <p>Đánh giá của bạn: 
                <span class="rating">
                    @for ($i = 1; $i <= 5; $i++)
                        <i class="fas fa-star {{ $i <= $data->rating ? 'text-warning' : 'text-secondary' }}"></i>
                    @endfor
                </span> ({{ $data->rating }} sao)
            </p>
            @endif

            <p>Trân trọng,<br/>Đội ngũ chăm sóc khách hàng</p>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} Công ty của bạn. Mọi quyền được bảo lưu.
        </div>
    </div>
</body>
</html>
