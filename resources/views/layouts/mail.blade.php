<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <style>
      body {
        margin: 0;
        padding: 0;
        background-color: #fff;
        color: #000;
        font-family:
          ui-sans-serif, system-ui, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol',
          'Noto Color Emoji';
        font-size: 15px;
        line-height: 1.6;
        -webkit-font-smoothing: antialiased;
      }
    </style>
  </head>
  <body>
    @isset($preview)
      <div style="display: none; max-height: 0; overflow: hidden">{{ $preview }}</div>
    @endisset

    {{ $slot }}

    <div class="footer">
      @isset($unsubscribe)
        <p>You received this email because you ...</p>
        <p><a href="{{ $unsubscribe }}">Unsubscribe</a></p>
      @endisset
    </div>
  </body>
</html>
