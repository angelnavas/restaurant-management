<!DOCTYPE html>
<html>
<head>
    <title>Restaurant Management</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-4">Restaurant Management API</h1>
        
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-semibold mb-4">Endpoints disponibles:</h2>
            
            <div class="space-y-4">
                <div>
                    <h3 class="font-bold">Recipes</h3>
                    <ul class="list-disc pl-5">
                        <li>GET /api/recipes</li>
                        <li>POST /api/recipes</li>
                        <li>GET /api/recipes/analytics</li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="font-bold">Products</h3>
                    <ul class="list-disc pl-5">
                        <li>GET /api/products</li>
                        <li>POST /api/products</li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="font-bold">Sales</h3>
                    <ul class="list-disc pl-5">
                        <li>POST /api/sales</li>
                        <li>GET /api/sales/analytics</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</body>
</html>