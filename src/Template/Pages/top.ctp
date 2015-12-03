<h1>StreakKeeper</h1>

<p>Don't stop your GitHub streak.</p>

<p>
<?= $this->Form->postLink(
    'Login with GitHub',
    ['controller' => 'Users', 'action' => 'login'],
    ['class' => 'btn']
) ?>
</p>
