<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'Admin Panel') - MPP Sukoharjo</title>
    
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    @stack('head-scripts')
    
    <style>
      :root{
        --bg:#f6f8fb; --card:#ffffff; --muted:#7b7b7b; --accent:#1a73e8;
        --shadow:0 6px 18px rgba(20,20,50,0.06); --radius:10px;
        font-family:Inter, system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
      }
      body {
        margin:0;background:var(--bg);color:#222;display:flex;overflow-x:hidden;min-height: 100vh;
        -webkit-font-smoothing: antialiased;
      }
      /* SIDEBAR */
      .sidebar {
        width:250px;background:#fff;height:100vh;border-right:1px solid #ddd;
        display:flex;flex-direction:column;position:fixed;z-index: 100;
        transition: transform 0.3s ease;
      }
      /* ... Lanjutkan salin semua CSS yang ada di tag <style> dashboard.html di sini ... */
      /* Karena CSS Anda cukup panjang, pastikan semua isinya dicopy ke dalam tag <style> ini. */
      
      .main-content {
        margin-left: 250px; /* Lebar sidebar */
        width: 100%;
        padding: 0;
        min-height: 100vh;
      }
      .topbar {
        background: var(--card); border-bottom: 1px solid #ddd;
        padding: 15px 30px; display: flex; justify-content: space-between;
        align-items: center; position: sticky; top: 0; z-index: 50;
      }
      
      /* ... Tambahkan CSS lain (media queries, hover, dll.) dari <style> ... */
    </style>
    
    @stack('styles') 
</head>
<body>

    <div class="sidebar">
      @include('layouts.sidebar') 
    </div>

    <div class="main-content">
        
        <header class="topbar">
          @include('layouts.topbar') 
        </header>

        <main class="page-content">
            @yield('content')
        </main>
    </div>

    @include('layouts.scripts')

    @stack('scripts')
</body>
</html>