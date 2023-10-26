<?php require_once('couch/cms.php'); ?>

<cms:template title='People' icon='people' clonable='1' order='2'>

    <cms:editable
        name='first_name'
        label='Last name'
        type='text'
    />

    <cms:editable
        name='last_name'
        label='Last name'
        type='text'
    />

    <cms:editable
        name='account'
        label='Account'
        type='relation'
        masterpage='accounts.php'
        has='one'
        advanced_gui='1'
    />

    <cms:editable
        name='credit_amount'
        label='Credit amount'
        type='text'
    />

</cms:template>

<?php COUCH::invoke(); ?>