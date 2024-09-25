<!DOCTYPE html>
<html>
<head>
    <title>Hasil Scraping</title>
</head>
<body>
    <h1>Hasil Scraping</h1>
    <ul>
        @foreach ($titles as $title)
            <li>{{ $title }}</li>
        @endforeach
    </ul>
</body>
</html>
