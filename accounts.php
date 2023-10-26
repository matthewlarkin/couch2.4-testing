<?php require_once('couch/cms.php');?>

<cms:template title='Accounts' clonable='1'>

    <cms:editable
        name='members'
        label='Members'
        type='reverse_relation'
        masterpage='people.php'
        field='account'
    />

    <cms:globals>
        <cms:editable
            name='default_credit_amount'
            label='Default credit amount'
            type='text'
        />
    </cms:globals>

</cms:template>

<?php COUCH::invoke();?>