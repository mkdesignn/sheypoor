@if ($breadcrumbs)
    <?php $links = ""; ?>
    <ol class="breadcrumb">
        @foreach ($breadcrumbs as $breadcrumb)
            @if ($breadcrumb->url && !$breadcrumb->last)
                <li><a href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a></li>
            @else
                <li class="active">{{ $breadcrumb->title }}</li>
            @endif
            @if( isset($breadcrumb->links) )
                <?php $links = $breadcrumb->links; ?>
            @endif
        @endforeach
        <?php echo $links; ?>
    </ol>
@endif