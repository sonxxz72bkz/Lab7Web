<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $title; ?></title>
    <link rel="stylesheet" href="<?= base_url('/style.css');?>">
</head>
<body>
    <div id="container">
    <header>
        <h1>Admin Panel</h1>
    </header>
    <nav>
        <a href="<?= base_url('/admin/artikel');?>">Dashboard Artikel</a>
        <a href="<?= base_url('/artikel/');?>">Artikel</a>
    </nav>
    <section id="wrapper">
        <section id="main">