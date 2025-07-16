<div class="deznav">
    <div class="deznav-scroll">
        <div class="main-profile">
            <div class="image-bx">
                <img src="{{ asset('images/Untitled-1.jpg') }}" alt="">
                <a href="javascript:void(0);"><i class="fa fa-cog" aria-hidden="true"></i></a>
            </div>
            <h5 class="name"><span class="font-w400">Hello,</span> {{ Auth::user()->name }}</h5>
            <p class="email">{{ Auth::user()->email }}</p>
        </div>
        <ul class="metismenu" id="menu">
            @foreach (config('menu') as $item)
                @if (isset($item['is_label']) && $item['is_label'] && hasAnyRole($item['roles']))
                    <li class="nav-label">{{ $item['label'] }}</li>
                @elseif(hasAnyRole($item['roles']))
                    @if (isset($item['children']))
                        <li>
                            <a class="has-arrow ai-icon" href="javascript:void(0)" aria-expanded="false">
                                <i class="{{ $item['icon'] }}"></i>
                                <span class="nav-text">{{ $item['name'] }}</span>
                            </a>
                            <ul aria-expanded="false">
                                @foreach ($item['children'] as $child)
                                    @if (hasAnyRole($child['roles']))
                                        <li><a href="{{ route($child['route']) }}">{{ $child['name'] }}</a></li>
                                    @endif
                                @endforeach
                            </ul>
                        </li>
                    @else
                        <li>
                            <a class="ai-icon" href="{{ route($item['route']) }}">
                                <i class="{{ $item['icon'] }}"></i>
                                <span class="nav-text">{{ $item['name'] }}</span>
                            </a>
                        </li>
                    @endif
                @endif
            @endforeach
        </ul>
    </div>
</div>
