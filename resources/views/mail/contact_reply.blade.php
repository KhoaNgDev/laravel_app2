<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Phản hồi từ Admin</title>
</head>
<body>
    <p>Xin chào <strong>{{ $data->name }}</strong>,</p>

    <p>Chúng tôi đã nhận được góp ý của bạn với nội dung:</p>
    <blockquote>{{ $data->message }}</blockquote>

    <p>Admin đã phản hồi cho bạn như sau:</p>
    <div style="padding:10px; border:1px solid #ccc; background-color:#f9f9f9;">
        {{ $data->admin_note }}
    </div>

    <p>Trạng thái hiện tại của góp ý: 
        @if($data->status === 'responded')
            Đã phản hồi
        @elseif($data->status === 'pending')
            Chưa xử lý
        @elseif($data->status === 'hidden')
            Spam
        @endif
    </p>

    <p>Trân trọng,<br/>Đội ngũ chăm sóc khách hàng</p>
</body>
</html>
