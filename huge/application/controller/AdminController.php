<?php

class AdminController extends Controller
{
    /**
     * Construct this object by extending the basic Controller class
     */
    public function __construct()
    {
        parent::__construct();

        // special authentication check for the entire controller: Note the check-ADMIN-authentication!
        // All methods inside this controller are only accessible for admins (= users that have role type 7)
        Auth::checkAdminAuthentication();
    }

    /**
     * This method controls what happens when you move to /admin or /admin/index in your app.
     */
    public function index()
    {
        $this->View->render('admin/index', array(
                'users' => UserModel::getPublicProfilesOfAllUsers())
        );
    }

    public function actionAccountSettings()
    {
        // DEBUG
        // Session::add('feedback_positive', print_r($_POST, true));
        // DEBUG END

        AdminModel::setAccountType(
            Request::post('account_type'),
            Request::post('user_id'),
            Request::post('userNameInput'),
            Request::post('userEmail')
        );
        
        if (Request::post('softDelete') == 'on') {
            AdminModel::softDeleteUser(Request::post('user_id'));
        }
        if (Request::post('removeSoftDelete') == 'on') {
            AdminModel::restoreUser(Request::post('user_id'));
        }

        if (Request::post('suspension') !== null && Request::post('suspension') !== '') {
           AdminModel::suspendUser(Request::post('suspension'), Request::post('user_id'));
        }

        Redirect::to("admin/index");
    }
}
