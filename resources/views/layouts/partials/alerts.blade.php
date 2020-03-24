@if (session('status'))
    <?php toast(session('status'),'info') ?>
@endif

@if (session('success'))
    <?php toast(session('success'),'success') ?>
@endif

@if (session('error'))
    <?php toast(session('error'),'error') ?>
@endif

@if (session('info'))
    <?php toast(session('info'),'info') ?>
@endif
