<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Public views

use Illuminate\Support\Facades\Notification;

Route::get('/', 'HomeController@view')->name('index');
Route::get('/map', 'HomeController@map')->name('map');
Route::get('/roster', 'AtcTraining\RosterController@showPublic')->name('roster.public');
Route::get('/staff', 'Users\StaffListController@index')->name('staff');
Route::get('/atcresources', 'Publications\AtcResourcesController@index')->name('atcresources.index');
Route::view('/pilots', 'pilots.index');
Route::view('/pilots/oceanic-clearance', 'pilots.oceanic-clearance');
Route::view('/pilots/position-report', 'pilots.position-report');
Route::view('/pilots/tracks', 'pilots.tracks');
Route::view('/pilots/tutorial', 'pilots.tutorial');
Route::get('/policies', 'Publications\PoliciesController@index')->name('policies');
Route::get('/meetingminutes', 'News\NewsController@minutesIndex')->name('meetingminutes');
Route::get('/bookings', 'ControllerBookings\ControllerBookingsController@indexPublic')->name('controllerbookings.public');
Route::view('/privacy', 'privacy')->name('privacy');
Route::view('/changelog', 'changelog')->name('changelog');
Route::view('/emailtest', 'emails.announcement');
Route::get('/events', 'Events\EventController@index')->name('events.index');
Route::get('/events/{slug}', 'Events\EventController@viewEvent')->name('events.view');
Route::view('/about', 'about')->name('about');
Route::view('/branding', 'branding')->name('branding');
Route::view('/eurosounds', 'eurosounds')->name('eurosounds');

Route::get('/test', function () {
    App\Jobs\UpdateDiscordUserRoles::dispatch();
});


//Authentication
Route::prefix('auth')->group(function () {
    Route::get('/sso/login', 'Auth\LoginController@ssoLogin')->middleware('guest')->name('auth.sso.login');
    Route::get('/sso/validate', 'Auth\LoginController@validateSsoLogin')->middleware('guest');
    Route::get('/connect/login', 'Auth\LoginController@connectLogin')->middleware('guest')->name('auth.connect.login');
    Route::get('/connect/validate', 'Auth\LoginController@validateConnectLogin')->middleware('guest');
    Route::get('/logout', 'Auth\LoginController@logout')->middleware('auth')->name('auth.logout');
});


//Public news articles
Route::get('/news/{id}', 'News\NewsController@viewArticlePublic')->name('news.articlepublic')->where('id', '[0-9]+');
Route::get('/news/{slug}', 'News\NewsController@viewArticlePublic')->name('news.articlepublic');
Route::get('/news/', 'News\NewsController@viewAllPublic')->name('news');

//Base level authentication
Route::group(['middleware' => 'auth'], function () {
    //Privacy accept
    Route::get('/privacyaccept', 'Users\UserController@privacyAccept');
    Route::get('/privacydeny', 'Users\UserController@privacyDeny');
    //Events
    Route::post('/dashboard/events/controllerapplications/ajax', 'Events\EventController@controllerApplicationAjaxSubmit')->name('events.controllerapplication.ajax');
    //Dashboard
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard.index');
    Route::post('/users/changeavatar', 'Users\UserController@changeAvatar')->name('users.changeavatar');
    Route::get('/users/changeavatar/discord', 'Users\UserController@changeAvatarDiscord')->name('users.changeavatar.discord');
    Route::get('/users/resetavatar', 'Users\UserController@resetAvatar')->name('users.resetavatar');
    Route::post('/users/changedisplayname', 'Users\UserController@changeDisplayName')->name('users.changedisplayname');
    Route::get('/users/defaultavatar/{id}', function ($id) {
        $user = \App\User::whereId($id)->firstOrFail();
        if ($user->isAvatarDefault()) {
            return true;
        }
        return false;
    });

    //CTP
    //Route::post('/dashboard/ctp/signup/post', 'DashboardController@ctpSignUp')->name('ctp.signup.post');
    //Notification
    Route::get('/notification/{id}', 'Users\NotificationRedirectController@notificationRedirect')->name('notification.redirect');
    Route::get('/notificationclear', 'Users\NotificationRedirectController@clearAll');
    //Tickets
    Route::get('/dashboard/tickets', 'Tickets\TicketsController@index')->name('tickets.index');
    Route::get('/dashboard/tickets/staff', 'Tickets\TicketsController@staffIndex')->name('tickets.staff')->middleware('executive');
    Route::get('/dashboard/tickets/{id}', 'Tickets\TicketsController@viewTicket')->name('tickets.viewticket');
    Route::post('/dashboard/tickets', 'Tickets\TicketsController@startNewTicket')->name('tickets.startticket');
    Route::post('/dashboard/tickets/{id}', 'Tickets\TicketsController@addReplyToTicket')->name('tickets.reply');
    Route::get('/dashboard/tickets/{id}/close', 'Tickets\TicketsController@closeTicket')->name('tickets.closeticket');

    //Feedback
    Route::get('/feedback', 'Feedback\FeedbackController@create')->name('feedback.create');
    Route::post('/feedback', 'Feedback\FeedbackController@createPost')->name('feedback.create.post');

    //Email prefs
    Route::get('/dashboard/emailpref', 'Users\DataController@emailPref')->name('dashboard.emailpref');
    Route::get('/dashboard/emailpref/subscribe', 'Users\DataController@subscribeEmails');
    Route::get('/dashboard/emailpref/unsubscribe', 'Users\DataController@unsubscribeEmails');
    //GDPR
    Route::get('/me/data', 'Users\DataController@index')->name('me.data');
    Route::post('/me/data/export/all', 'Users\DataController@exportAllData')->name('me.data.export.all');
    //Applications
    Route::group(['middleware' => 'notcertified'], function () {
        Route::get('/dashboard/application', 'AtcTraining\ApplicationsController@startApplicationProcess')->name('application.start');
        Route::post('/dashboard/application', 'AtcTraining\ApplicationsController@submitApplication')->name('application.submit');
    });
    Route::get('/dashboard/application/list', 'AtcTraining\ApplicationsController@viewApplications')->name('application.list');
    Route::get('/dashboard/application/{application_id}', 'AtcTraining\ApplicationsController@viewApplication')->name('application.view');
    Route::get('/dashboard/application/{application_id}/withdraw', 'AtcTraining\ApplicationsController@withdrawApplication');
    //"Me"
    Route::get('/me/editbiography', 'Users\UserController@editBioIndex')->name('me.editbioindex');
    Route::post('/me/editbiography', 'Users\UserController@editBio')->name('me.editbio');
    Route::get('/me/discord/link', 'Users\UserController@linkDiscord')->name('me.discord.link');
    Route::get('/me/discord/unlink', 'Users\UserController@unlinkDiscord')->name('me.discord.unlink');
    Route::get('/me/discord/link/redirect', 'Users\UserController@linkDiscordRedirect')->name('me.discord.link.redirect');
    Route::get('/me/discord/server/join', 'Users\UserController@joinDiscordServerRedirect')->name('me.discord.join');
    Route::get('/me/discord/server/join/redirect', 'Users\UserController@joinDiscordServer');
    Route::get('/me/preferences', 'Users\UserController@preferences')->name('me.preferences');
    Route::post('/me/preferences', 'Users\UserController@preferencesPost')->name('me.preferences.post');
    //Bookings
    Route::group(['middleware' => 'certified'], function () {
        Route::get('/dashboard/bookings', 'ControllerBookings\ControllerBookingsController@index')->name('controllerbookings.index');
        Route::get('/dashboard/bookings/create', 'ControllerBookings\ControllerBookingsController@create')->name('controllerbookings.create');
        Route::post('/dashboard/bookings/create', 'ControllerBookings\ControllerBookingsController@createPost')->name('controllerbookings.create.post');
    });
    //AtcTraining
    Route::get('/dashboard/training', 'AtcTraining\TrainingController@index')->name('training.index');
    Route::group(['middleware' => 'instructor'], function () {
        Route::get('/dashboard/training/sessions', 'AtcTraining\TrainingController@instructingSessionsIndex')->name('training.instructingsessions.index');
        Route::get('/dashboard/training/sessions/{id}', 'AtcTraining\TrainingController@viewInstructingSession')->name('training.instructingsessions.viewsession');
        Route::view('/dashboard/training/sessions/create', 'dashboard.training.instructingsessions.create')->name('training.instructingsessions.createsessionindex');
        Route::get('/dashboard/training/sessions/create', 'AtcTraining\TrainingController@createInstructingSession')->name('training.instructingsessions.createsession');
        Route::get('/dashboard/training/instructors', 'AtcTraining\TrainingController@instructorsIndex')->name('training.instructors');
        Route::get('/dashboard/training/students/current', 'AtcTraining\TrainingController@currentStudents')->name('training.students.current');
        Route::get('/dashboard/training/students/{id}', 'AtcTraining\TrainingController@viewStudent')->name('training.students.view');
        Route::post('/dashboard/training/students/{id}/assigninstructor', 'AtcTraining\TrainingController@assignInstructorToStudent')->name('training.students.assigninstructor');
        Route::post('/dashboard/training/students/{id}/setstatus', 'AtcTraining\TrainingController@changeStudentStatus')->name('training.students.setstatus');
    });
    //Staff
    Route::group(['middleware' => 'director'], function () {
        Route::get('/dashboard/ctp/signups', function () {
            $signups = \App\CtpSignUp::all();
            foreach ($signups as $s) {
                echo $s.'<br/>';
            }
        })->name('ctp.signup.list');
        //ATC Resources
        Route::post('/atcresources', 'Publications\AtcResourcesController@uploadResource')->name('atcresources.upload');
        Route::get('/atcresources/delete/{id}', 'Publications\AtcResourcesController@deleteResource')->name('atcresources.delete');
        //News
        Route::get('/admin/news', 'News\NewsController@index')->name('news.index');
        Route::get('/admin/news/article/create', 'News\NewsController@createArticle')->name('news.articles.create');
        Route::post('/admin/news/article/create', 'News\NewsController@postArticle')->name('news.articles.create.post');
        Route::get('/admin/news/article/{slug}', 'News\NewsController@viewArticle')->name('news.articles.view');
        Route::get('/admin/news/announcement/create', 'News\NewsController@createAnnouncement')->name('news.announcements.create');
        Route::post('/admin/news/announcement/create', 'News\NewsController@createAnnouncementPost')->name('news.announcements.create.post');
        Route::get('/admin/news/announcement/{slug}', 'News\NewsController@viewAnnouncement')->name('news.announcements.view');
        //Roster
        Route::get('/dashboard/roster', 'AtcTraining\RosterController@index')->name('roster.index');
        Route::post('/dashboard/roster', 'AtcTraining\RosterController@addController')->name('roster.addcontroller');
        Route::post('/dashboard/roster/{id}', 'AtcTraining\RosterController@editController')->name('roster.editcontroller');
        Route::get('/dashboard/roster/{id}', 'AtcTraining\RosterController@viewController')->name('roster.viewcontroller');
        Route::get('/dashboard/roster/{cid}/delete', 'AtcTraining\RosterController@deleteController')->name('roster.deletecontroller');
        //Events
        Route::get('/admin/events', 'Events\EventController@adminIndex')->name('events.admin.index');
        Route::get('/admin/events/create', 'Events\EventController@adminCreateEvent')->name('events.admin.create');
        Route::post('/admin/events/create', 'Events\EventController@adminCreateEventPost')->name('events.admin.create.post');
        Route::post('/admin/events/{slug}/edit', 'Events\EventController@adminEditEventPost')->name('events.admin.edit.post');
        Route::post('/admin/events/{slug}/update/create', 'Events\EventController@adminCreateUpdatePost')->name('events.admin.update.post');
        Route::get('/admin/events/{slug}', 'Events\EventController@adminViewEvent')->name('events.admin.view');
        Route::get('/admin/events/{slug}/delete', 'Events\EventController@adminDeleteEvent')->name('events.admin.delete');
        Route::get('/admin/events/{slug}/controllerapps/{cid}/delete', 'Events\EventController@adminDeleteControllerApp')->name('events.admin.controllerapps.delete');
        Route::get('/admin/events/{slug}/updates/{id}/delete', 'Events\EventController@adminDeleteUpdate')->name('events.admin.update.delete');
        //Users
        Route::get('/admin/users/', 'Users\UserController@viewAllUsers')->middleware('director')->name('users.viewall');
        Route::post('/admin/users/search/ajax', 'Users\UserController@searchUsers')->name('users.search.ajax');
        Route::get('/admin/users/{id}', 'Users\UserController@viewUserProfile')->name('users.viewprofile');
        Route::post('/admin/users/{id}', 'Users\UserController@createUserNote')->name('users.createnote');
        Route::get('/admin/users/{user_id}/note/{note_id}/delete', 'Users\UserController@deleteUserNote')->name('users.deletenote');
        Route::group(['middleware' => 'executive'], function () {
            Route::post('/admin/users/func/avatarchange', 'Users\UserController@changeUsersAvatar')->name('users.changeusersavatar');
            Route::post('/admin/users/func/avatarreset', 'Users\UserController@resetUsersAvatar')->name('users.resetusersavatar');
            Route::post('/admin/users/func/bioreset', 'Users\UserController@resetUsersBio')->name('users.resetusersbio');
            Route::get('/admin/users/{id}/delete', 'Users\UserController@deleteUser');
            Route::get('/admin/users/{id}/edit', 'Users\UserController@editUser')->name('users.edit.create');
            Route::post('/admin/users/{id}/edit', 'Users\UserController@storeEditUser')->name('users.edit.store');
            Route::post('/admin/users/{id}/bookingban/create', 'Users\UserController@createBookingBan')->name('users.bookingban.create');
            Route::post('/admin/users/{id}/bookingban/remove', 'Users\UserController@removeBookingBan')->name('users.bookingban.remove');
        });
        Route::get('/admin/users/{id}/email', 'Users\UserController@emailCreate')->name('users.email.create');
        Route::get('/admin/users/{id}/email', 'Users\UserController@emailStore')->name('users.email.store');
        //Controller Applications
        Route::get('/dashboard/training/applications', 'AtcTraining\TrainingController@viewAllApplications')->name('training.applications');
        Route::get('/dashboard/training/applications/{id}', 'AtcTraining\TrainingController@viewApplication')->name('training.viewapplication');
        Route::group(['middleware' => 'executive'], function () {
            Route::get('/dashboard/training/applications/{id}/accept', 'AtcTraining\TrainingController@acceptApplication')->name('training.application.accept');
            Route::get('/dashboard/training/applications/{id}/deny', 'AtcTraining\TrainingController@denyApplication')->name('training.application.deny');
            Route::post('/dashboard/training/applications/{id}/', 'AtcTraining\TrainingController@editStaffComment')->name('training.application.savestaffcomment');
        });
        //AtcTraining
        Route::post('/dashboard/training/instructors', 'AtcTraining\TrainingController@addInstructor')->name('training.instructors.add');
        //Minutes
        Route::get('/meetingminutes/{id}', 'News\NewsController@minutesDelete')->name('meetingminutes.delete');
        Route::post('/meetingminutes', 'News\NewsController@minutesUpload')->name('meetingminutes.upload');
        //Network
        Route::get('/admin/network', 'Network\NetworkController@index')->name('network.index');
        Route::get('/admin/network/monitoredpositions', 'Network\NetworkController@monitoredPositionsIndex')->name('network.monitoredpositions.index');
        Route::get('/admin/network/monitoredpositions/{position}', 'Network\NetworkController@viewMonitoredPosition')->name('network.monitoredpositions.view');
        Route::post('/admin/network/monitoredpositions/create', 'Network\NetworkController@createMonitoredPosition')->name('network.monitoredpositions.create');

        //Policy creation and settings
        Route::group(['middleware' => 'executive'], function () {
            Route::post('/policies', 'Publications\PoliciesController@addPolicy')->name('policies.create');
            Route::get('/policies/{id}/delete', 'Publications\PoliciesController@deletePolicy');

            //Settings
            Route::prefix('admin/settings')->group(function () {
                Route::get('/', 'Settings\SettingsController@index')->name('settings.index');
                Route::get('/site-information', 'Settings\SettingsController@siteInformation')->name('settings.siteinformation');
                Route::post('/site-information', 'Settings\SettingsController@saveSiteInformation')->name('settings.siteinformation.post');
                Route::get('/emails', 'Settings\SettingsController@emails')->name('settings.emails');
                Route::post('/emails', 'Settings\SettingsController@saveEmails')->name('settings.emails.post');
                Route::get('/audit-log', 'Settings\SettingsController@auditLog')->name('settings.auditlog');
                Route::get('/rotation-images', 'Settings\SettingsController@rotationImages')->name('settings.rotationimages');
                Route::get('/rotation-images/delete/{image_id}', 'Settings\SettingsController@deleteRotationImage')->name('settings.rotationimages.deleteimg');
                Route::post('/rotation-images/uploadimg', 'Settings\SettingsController@uploadRotationImage')->name('settings.rotationimages.uploadimg');
                Route::get('/staff', 'Users\StaffListController@editIndex')->name('settings.staff');
                Route::post('/staff/{id}', 'Users\StaffListController@editStaffMember')->name('settings.staff.editmember');
            });
        });
    });
});
