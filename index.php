<?php require_once('couch/cms.php'); ?>

<cms:template title='Home' icon='home' order='1' />

<cms:set action="<cms:gpc 'action' />" />





<!-- Markup -->

<html>
    <head>
        <title>People <cms:if action>(<cms:show action />)</cms:if></title>
    </head>
    <body>

        <header style="text-align:center;padding:24px;">
            <nav>
                <a href="?action=create-manual">Create (hardcoded values)</a>
                <a href="?action=create-set">Create (set values)</a>
                <a href="?action=edit">Edit</a>
                <a href="?action=delete">Delete</a>
            </nav>
        </header>





        <!-- CREATE (hardcoded values) -->

        <cms:if action='create-manual'>

            <cms:db_persist
                _masterpage='accounts.php'
                _mode='create'
                _auto_title='1'
            ><cms:set account_id=k_last_insert_id scope='global' /></cms:db_persist>

            <cms:db_persist
                _masterpage='people.php'
                _mode='create'
                _auto_title='1'
                first_name='Matthew'
                last_name='Larkin'
                credit_amount='100'
                account=account_id
            ><cms:set person_id=k_last_insert_id scope='global' />
                
                <cms:if k_success>
                    <cms:pages masterpage='accounts.php' id=account_id limit='1' show_future_entries='1'>
                        Successfully created account: <a href="<cms:admin_link />"><cms:show k_page_title /></a><br /><br />
                    </cms:pages>
                    <cms:pages masterpage='people.php' id=person_id limit='1' show_future_entries='1'>
                        Successfully created person: <a href="<cms:admin_link />"><cms:show first_name /> <cms:show last_name /></a>
                    </cms:pages>
                </cms:if>

                <cms:if k_error>
                    <cms:each k_error>
                        <cms:show item /><br />
                    </cms:each>
                </cms:if>

            </cms:db_persist>

        </cms:if>





        <!-- CREATE (set values) -->

        <cms:if action='create-set'>

            <cms:set first_name="Kamran" />
            <cms:set last_name="Kashif" />

            <cms:db_persist
                _masterpage='people.php'
                _mode='create'
                _auto_title='1'
                first_name="<cms:show first_name />"
                last_name=last_name
            >
                    
                    <cms:if k_success>
                        <cms:pages masterpage='people.php' id=k_last_insert_id limit='1' show_future_entries='1'>
                            Successfully created person: <a href="<cms:admin_link />"><cms:show first_name /> <cms:show last_name /></a>
                        </cms:pages>
                    </cms:if>
    
                    <cms:if k_error>
                        <cms:each k_error>
                            <cms:show item /><br />
                        </cms:each>
                    </cms:if>

            </cms:db_persist>

        </cms:if>





        <!-- EDIT -->

        <cms:if action='edit'>

            <cms:pages masterpage='people.php' limit='1' show_future_entries='1'>
                <cms:if k_count>
                    <cms:db_persist
                        _masterpage='people.php'
                        _mode='edit'
                        _auto_title='1'
                        _page_id=k_page_id
                        first_name='Edited'
                        last_name='Person'
                    >
                        <cms:if k_success>
                            <cms:pages masterpage='people.php' id=k_page_id limit='1' show_future_entries='1'>
                                Successfully edited person: <a href="<cms:admin_link />"><b><cms:show first_name /> <cms:show last_name /></b></a>
                            </cms:pages>
                        </cms:if>

                        <cms:if k_error>
                            <cms:each k_error>
                                <cms:show item /><br />
                            </cms:each>
                        </cms:if>

                    </cms:db_persist>
                </cms:if>
            </cms:pages>

        </cms:if>





        <!-- DELETE -->

        <cms:if action='delete'>

            <cms:pages masterpage='people.php' limit='1' show_future_entries='1'>
                <cms:if k_count>
                    <cms:db_delete
                        masterpage='people.php'
                        page_id=k_page_id
                    />
                    Deleted person: <b><cms:show first_name /> <cms:show last_name /></b>
                </cms:if>
            </cms:pages>

        </cms:if>





    </body>

</html>

<?php COUCH::invoke(); ?>