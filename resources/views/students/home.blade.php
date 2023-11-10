<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    Trang home student
    <div class="dropdown-menu dropdown-menu-end pt-0">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <a class="dropdown-item" href="{{ route('logout') }}"
               onclick="event.preventDefault(); this.closest('form').submit();">
                <svg class="icon me-2">
                    <use xlink:href="{{ asset('icons/coreui.svg#cil-account-logout') }}"></use>
                </svg>
                {{ __('Logout') }}
            </a>
        </form>
    </div>
</body>
</html>
