<?php

/************************************************************************/
/* File Repository                                                      */
/* ===========================                                          */
/*                                                                      */
/* Copyright (c) 2008 by MJ Hufford                                     */
/* http://www.GuitarVoice.com                                           */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/

define("_FILEREPOSITORY","File Repository");
define("_ADMINTITLE","File Repository Administration");
define("_FUNCTIONS","Functions");
define("_YES","Yes");
define("_NO","No");
define("_LANGUAGE","Language");
define("_DESCRIPTION","Description");
define("_TITLE","Title");
define("_ADD","Add");
define("_EDIT","Edit");
define("_UPDATE","Update");
define("_DELETE","Delete");
define("_ADDCATEGORY","Add a New Category");
define("_EDITCATEGORY","Edit Category");
define("_CATEGORY","Category");
define("_CATEGORIES","Categories");
define("_CATEGORIESTITLE","Click here to manage categories");
define("_DELCONTENTCAT","WARNING: Are you sure you want to delete this category? Pages under this category, if they exist, will not be removed, but will not be attached to any category.");
define("_DELCATEGORY","Delete Category");
define("_APPS","Applications");
define("_APPSTITLE","Click here to manage applications");
define("_ADDAPPS","Add Application");
define("_MODAPPS","Modify an Application");
define("_EXT","File Extensions");
define("_EXTTITLE","Click here to manage file extensions");
define("_ADDEXT","Add File Extensions");
define("_MODEXT","Modify a File Extension");
define("_FILES","Files");
define("_FILESTITLE","Click here to manage files");
define("_ADDFILES","Add a File");
define("_MODFILES","Modify a File");
define("_RATINGS","Ratings");
define("_RATINGSTITLE","Click here to manage ratings");
define("_ACCESSRESTRICT","Access Restrictions");
define("_ACCESSRESTRICTTITLE","Click to manage Access Restrictions");
define("_BROKENTITLE","Click here to view the broken files report.");
define("_BROKEN","Broken Files Report");
define("_AWAITAPPROVETITLE","Click to view files awaiting approval.");
define("_AWAITAPPROVE","File Awaiting Approval");
define("_GHOSTFILESTITLE","Click to clean ghost files.");
define("_GHOSTFILES","Ghost Files");
define("_ADMINOPTION","<b>Select an administrative option above.</b>");
define("_THEREARE","There are");
define("_FILESIN","files in");
define("_APPSAND","applications and");
define("_CATSINDB","categories in our database");
define("_CATNAME","Category Name");
define("_CATIMAGE","Category Image");
define("_SUBMIT","Submit");
define("_DESCRIPTION","Description");
define("_NOAPPS","There are no applications in the database.");
define("_CATSELECT","Select Category");
define("_MODIFY","Modify");
define("_UNAPPROVEDEXT","does not have an approved file extension.  Only images with .JPG or .GIF extensions can be associated with a category.<br/><br/><a href=\"javascript:history.go(-1)\">Click here</a> to go back.");
define("_UPLOADERROR","Upload Error!");
define("_UPLOADMESSAGE","There was an error uploading the image.  <a href=\"javascript:history.go(-1)\">Click here</a> to try again.");
define("_SUCCESS","Success!");
define("_CATINSERTED","The category was successfully inserted into the database.");
define("_REDIRECTED","You are being redirected.");
define("_SQLERROR","SQL ERROR!");
define("_SQLERRORMSG","There was a problem with the SQL statement.");
define("_CURRENTIMAGE","Current category image");
define("_UPLOADERASE","By uploading a new image, the original image will be overwritten.");
define("_CATDELETE","Delete Category");
define("_ATTACHERROR","ATTACHMENT ERROR!");
define("_CATUPDATED","The category was successfully updated in the database.");
define("_CONFIRMDELETE","Confirm & Delete");
define("_CONFIRMCATDELETE","Are you sure you want to delete this category");
define("_APPFILES","files associated with this application.");
define("_ALLAPPSDELETE","If you proceed, all associated applications and files will also be deleted.");
define("_CATDELETEMSG","The category, associated applications and files were deleted from the database.");
define("_CANCEL","Cancel");
define("_APPNAME","Applicaiton Name");
define("_APPURL","Application Homepage");
define("_SHOWCUSTOMFIELD","Show Custom Field");
define("_APPICON","Application Icon");
define("_CURRENTAPPICON","Current Application Icon");
define("_FIELD","Field");
define("_LABEL","Label");
define("_DELETEAPP","Delete Application");
define("_APPUPDATED","The application was successfully updated in the database.");
define("_CONFIRMAPPDELETE","Are you sure you want to delete this application");
define("_APPDELETEMSG","The application and all associated files were deleted from the database.");
define("_SELECTAPP","Select Application");
define("_FILEEXT","File Exentension");
define("_DELETEEXT","Delete Extension");
define("_EXTUPDATED","The file extension was successfully updated.");
define("_CONFIRMEXTDELETE","Are you sure you want to delete this extension");
define("_EXTDELETE","The extension was deleted from the database.");
define("_APPROVEDEXT","Approved file extensions for this application");
define("_NOFILES","There are no files in the database.");
define("_SELECTFILE","Select File");
define("_NOAPPFILEEXT","There are no file extensions associated with this application.");
define("_NEWFILEEXT","Click here to add new file extensions.");
define("_UNAPPROVEDFILE","is not approved for the application you selected.  Approved file extensions are listed below.");
define("_FILETRYAGAIN","Please <a href=\"javascript:history.go(-1)\">attach</a> a file with an approved extension.");
define("_FILEEXTERROR","File Extension Error!");
define("_UPLOADAPPROVE","The file was successfully uploaded and approved!");
define("_FILEUPLOADMSG","There was an error uploading the file. <a href=\"javascript:history.go(-1)\">Click here</a> to try again.");
define("_SUBMITTER","Submitter");
define("_IPADDRESS","IP Address");
define("_TCOMMENTS","Comments");
define("_CLICKTOVIEW","Click to view file.");
define("_NEWFILEWARN","By uploading a new file, you will permanantly delete the old file.");
define("_FILEUPDATED","The file was successfully updated and approved!");
define("_SELECTCATEGORY","Select Category");
define("_NEXT","Next");
define("_APPLICATION","Application");
define("_USERNAME","Username");
define("_FILE","File");
define("_CONFIRMFILEDELETE","Are you sure you want to delete this file?");
define("_DENIALREASON","Denial Reason");
define("_DENIALBOXNOTES","**Please explain why the file is being deleted/denied. The user will be notified of your comments.**");
define("_FILEDELETED","File successfully deleted");
define("_FILENOTDELETED","File was not deleted.  You may need to manually delete the file from the directory.");
define("_NOMATCHINGFILE","There is no matching file in the directory.");
define("_FILEDELETEDMSG","The record was deleted from the database. <br />The submitter has been notified<br />The delete file action returned the following statement:");
define("_RECORDNOTDELETE","The record was not deleted from the database.");
define("_DELETEFILEACTION","The delete file action returned the following statement:");
define("_GOBACK","<a href=\"javascript:history.go(-1)\">Go Back</a>");
define("_NOAPPROVEFILES","There are no files currently awaiting administrative approval.");
define("_NOPENDINGFILES","No Files!");
define("_APPROVEDENY","Approve / Deny");
define("_FILESAWAITINGAPPROVE","Files Awaiting Approval");
define("_BROKENREPORT","Broken Files Report");
define("_NOBROKEN","There are no reported broken files in the database at this time.");
define("_RECORDDELETE","The record in the files table was deleted.");
define("_BROKENDELETE","The record in the broken report was deleted.");
define("_GHOSTINDIR","ghost files in your files directory.");
define("_DELETEGHOST","Delete All Ghost Files");
define("_CUSTOMTITLE","Modify User Custom Access");
define("_DATEENTERED","Date Entered");
define("_SELECTCUSTOMLEVEL","Select Custom Level");
define("_UNLIMITTED","Unlimitted");
define("_DENIED","Denied");
define("_DENY","Deny");
define("_DAYDURATION","Duration in Days");
define("_RESTRICTIONS","File Access Restrictions");
define("_RESTRICTNOTES","Use this section to set access permsions to the File Repository.  If you don't wish to restrict access, enter zeros (0) for all the values.  Admins will always full access.");
define("_DONATLEAST","If a user has donated at least");
define("_FILESINLAST","files in the last");
define("_DONRESULT","days then he/she will have full access to the File Repository.");
define("_DONELSE","Otherwise, users will be permitted to download");
define("_ELSEFILES","files every");
define("_DAYS","Days");
define("_CUSTOMACCESS","User Custom Access");
define("_SELECTUSER","Select User");
define("_SELECTCUSTOMLEVEL","Select Custom Level");
define("_SELECTACCESSTYPE","Select Access Type");
define("_UNLIMITTED","Unlimitted");
define("_NOCUSTOMUSERS","There are no users with custom access at this time.");
define("_MODIFYCUSTOM","Modify Custom Access");
define("_NOPERMISSION","You do not have administration permission for module");
define("_RATINGSDELETEDMSG","All ratings were deleted successfully!");
define("_RATINGSNOTDELETE","There was a problem deleting the ratings.");
?>