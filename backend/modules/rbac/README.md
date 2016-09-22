RBAC Manager for Yii 2
=========


Usage
------------
Once the extension is installed, simply modify your application configuration as follows:

        return [
            //....
            'modules' => [
                .....
                'admin' => [
                    'class' => 'backend\Module',
                    'modules' => [
                        'rbac' => [
                            'class' => 'backend\modules\rbac\Module',
                        ],
                    ]
                ],
            ],
          'components' => [
                ....
                'authManager' => [
                    'class' => 'backend\modules\rbac\components\DbManager',
                    'defaultRoles' => ['guest', 'user'],
                ],
            ]
        ];


Run migrations:

    php yii migrate/up --migrationPath=@backend/modules/rbac/migrations

You can then access Auth manager through the following URL:

    http://localhost/path/to/index.php?r=admin/rbac/
    http://localhost/path/to/index.php?r=admin/rbac/route
    http://localhost/path/to/index.php?r=admin/rbac/permission
    http://localhost/path/to/index.php?r=admin/rbac/menu
    http://localhost/path/to/index.php?r=admin/rbac/role
    http://localhost/path/to/index.php?r=admin/rbac/assignment


For applying rules add to your controller following code:

    use backend\modules\rbac\components\AccessControl;

    class ExampleController extends Controller 
    {
    
    /**
     * Returns a list of behaviors that this component should behave as.
     */
    public function behaviors()
        {
            return [
                'access' => [
                    'class' => AccessControl::className(),
                ],
                'verbs' => [
                    ...
                ],
            ];
        }
      // Your actions
    }

