<!DOCTYPE html>
<html>
<head>
    <title>API Dokumentacja</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/swagger-ui/4.15.5/swagger-ui.min.css">
</head>
<body>
    <div id="swagger-ui"></div>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/swagger-ui/4.15.5/swagger-ui-bundle.min.js"></script>
    <script>
        window.onload = () => {
            SwaggerUIBundle({
                url: '/docs.json',
                dom_id: '#swagger-ui',
            });
        };
    </script>
</body>
</html>
