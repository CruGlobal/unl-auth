<?php
/**
 * Make package file for the UNL_UCBCN package.
 * 
 * @package UNL_Auth
 * @author Brett Bieber
 */

ini_set('display_errors',true);

/**
 * Require the PEAR_PackageFileManager2 classes, and other
 * necessary classes for package.xml file creation.
 */
require_once 'PEAR/PackageFileManager2.php';
require_once 'PEAR/PackageFileManager/File.php';
require_once 'PEAR/Task/Postinstallscript/rw.php';
require_once 'PEAR/Config.php';
require_once 'PEAR/Frontend.php';

/**
 * @var PEAR_PackageFileManager
 */
PEAR::setErrorHandling(PEAR_ERROR_DIE);
chdir(dirname(__FILE__));
$pfm = PEAR_PackageFileManager2::importOptions('package.xml', array(
//$pfm = new PEAR_PackageFileManager2();
//$pfm->setOptions(array(
    'packagedirectory' => dirname(__FILE__),
    'baseinstalldir' => '/',
    'filelistgenerator' => 'svn',
    'ignore' => array(  'package.xml',
                        '.project',
                        '*.tgz',
                        'makepackage.php',
                        '*CVS/*',
                        '*.sh',
                        '*.svg',
                        '.cache',
                        'dataobject.ini',
                        'DBDataObjects',
                        'insert_sample_data.php',
                        'install.sh',
                        '*tests*',
                        'test.txt',
                        '*scripts*'),
    'simpleoutput' => true,
    'roles'=>array('php'=>'php' ),
    'exceptions'=>array()
));
$pfm->setPackage('UNL_Auth');
$pfm->setPackageType('php'); // this is a PEAR-style php script package
$pfm->setSummary('An authentication framework for PHP Applications at UNL');
$pfm->setDescription('This package provides an authentication framework for web 
applications developed at UNL.');
$pfm->setChannel('pear.unl.edu');
$pfm->setAPIStability('alpha');
$pfm->setReleaseStability('alpha');
$pfm->setAPIVersion('0.1.1');
$pfm->setReleaseVersion('0.1.1');
$pfm->setNotes('
* Check if session is already started - kabel
* Improve PHP docs and fix example. - bbieber');

//$pfm->addMaintainer('lead','saltybeagle','Brett Bieber','brett.bieber@gmail.com');
$pfm->setLicense('BSD License', 'http://www1.unl.edu/wdn/wiki/Software_License');
$pfm->clearDeps();
$pfm->setPhpDep('5.0.0');
$pfm->setPearinstallerDep('1.4.3');
$pfm->addPackageDepWithChannel('optional', 'Auth', 'pear.php.net', '1.0');
$pfm->addPackageDepWithChannel('optional', 'CAS',  'pear.unl.edu', '0.6.0RC6');

$pfm->generateContents();
if (isset($_SERVER['argv']) && $_SERVER['argv'][1] == 'make') {
    $pfm->writePackageFile();
} else {
    $pfm->debugPackageFile();
}
