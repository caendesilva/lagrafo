<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ Lagrafo::appName() }} - {{ $document->title }}</title>
    {!!  Lagrafo::styles() !!}
</head>
<body id="lagrafo-app">
<nav id="navigation-menu">
    <button id="toggle-nav">
        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000">
            <path d="M0 0h24v24H0z" fill="none"/>
            <path d="M3 18h18v-2H3v2zm0-5h18v-2H3v2zm0-7v2h18V6H3z"/>
        </svg>
    </button>

    <strong>
        <a href="{{ Lagrafo::route('index') }}">{{ Lagrafo::appName() }}</a>
    </strong>

    <form action="" method="GET">
        <label>
            <input type="text" name="search" placeholder="Search...">
        </label>
        <input type="submit" class="interactive-element">
    </form>
</nav>
<aside id="sidebar">
    <nav id="sidebar-navigation">
        <ul id="sidebar-navigation-menu">
            <li class="sidebar-navigation-item active" aria-current="page">
                <a href="{{ Lagrafo::route('index') }}"></a>
            </li>
            <li class="sidebar-navigation-item">
                <a href="{{ Lagrafo::route('index') }}"></a>
            </li>
            <li class="sidebar-navigation-item">
                <a href="{{ Lagrafo::route('index') }}"></a>
            </li>
        </ul>
    </nav>
    <footer id="sidebar-footer">
        <p>
            <a href="{{ route('home') ?? '/' }}">Back to app</a>
        </p>
    </footer>
</aside>
<main id="content">
    <article class="prose">
        <header>
            <h1>{{ $document->title }}</h1>
        </header>
        <section>
            {!! $document->html !!}
        </section>
        <footer>
            <a href="">Edit this page</a>

            <a href=""><< Previous</a>
            <a href="">Next >></a>
        </footer>
    </article>
</main>
<footer id="page-footer">
    <small>
        Site built with <a href="https://github.com/caendesilva/lagrafo">Lagrafo</a>
    </small>
</footer>
</body>
</html>
