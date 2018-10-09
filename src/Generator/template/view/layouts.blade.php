<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>管理系统</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
    #section('header')
        #include('{{$group}}.common.header')
    #show

</head>
<body>

<!--主体-->
#yield('content')

<!--底部-->
#section("footer")
    #include('{{$group}}.common.footer')
#show

</body>
</html>
