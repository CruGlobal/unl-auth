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
                        '*scripts*',
                        'CasZendAuthAdapter.php'),
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
$pfm->setAPIVersion('0.3.0');
$pfm->setReleaseVersion('0.3.1');
$pfm->setNotes('
* Increase SimpleCAS dependency of 0.2.0 to take advantage of getRequest() so we can ignore the ssl peer verification.');

$pfm->updateMaintainer('lead','saltybeagle','Brett Bieber','brett.bieber@gmail.com');
$pfm->setLicense('BSD License', 'http://www1.unl.edu/wdn/wiki/Software_License');
$pfm->clearDeps();
$pfm->setPhpDep('5.1.2');
$pfm->setPearinstallerDep('1.4.3');
$pfm->addPackageDepWithChannel('optional', 'Auth', 'pear.php.net', '1.0');
$pfm->addPackageDepWithChannel('optional', 'CAS',  'pear.unl.edu', '1.0.0');
$pfm->addPackageDepWithChannel('optional', 'SimpleCAS',  'simplecas.googlecode.com/svn', '0.2.0');


$pfm->generateContents();

$pfm->writePackageFile();
