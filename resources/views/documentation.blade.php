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
<aside id="sidebar">

    <header id="sidebar-header">
        <div id="sidebar-brand">
            <strong>
                <a href="{{ Lagrafo::route('index') }}">{{ Lagrafo::appName() }}</a>
            </strong>
        </div>
        <form id="search-form" action="{{ route('docs.search') }}" method="POST">
            <label>
                <input type="search" id="search" name="search" placeholder="Search..." value="{{ request()->get('search') }}" required>
            </label>
            <input type="submit" id="submit" class="interactive-element">
        </form>
    </header>
    <nav id="sidebar-navigation">
        <ul id="sidebar-navigation-menu" role="list">
@foreach(Lagrafo::getSidebarItems() as $item)
            <li {!! $item->destination == request()->url()
                        ? 'class="sidebar-navigation-item active" aria-current="page"'
                        : 'class="sidebar-navigation-item"' !!}>
                <a href="{{ $item->destination }}">{{ $item->label }}</a>
            </li>
@endforeach
        </ul>
    </nav>
    <footer id="sidebar-footer">
        <p>
            <a href="{{ route('home') ?? '/' }}">Back to app</a>
        </p>
    </footer>
</aside>
<main id="content">
    <article id="document" class="prose">
        <section id="document-main-content">
            {!! $document->html !!}
        </section>
        <footer id="document-footer">
@isset($pagination)
            <nav id="pagination">
                {!! $pagination->previous() !!}

                {!! $pagination->next() !!}
            </nav>
@endisset

@isset($document->data['source'])
            <a href="{{ $document->data['source'] }}">Edit this page</a>
@endisset
        </footer>
    </article>

    <footer id="page-footer">
        <small>
            Site built with <a href="https://github.com/caendesilva/lagrafo">Lagrafo</a>
        </small>
    </footer>
</main>
</body>
</html>
