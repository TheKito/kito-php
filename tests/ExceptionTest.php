<?php
use PHPUnit\Framework\TestCase;

class ExceptionTest extends TestCase
{
    public function testKitoCryptographyException()
    {        
        $this->expectException(Kito\Cryptography\Exception::class);
        throw new Kito\Cryptography\Exception("Test");
    }

    public function testKitoCryptographyHashAlgorithmCalcException()
    {        
        $this->expectException(Kito\Cryptography\HashAlgorithmCalcException::class);
        throw new Kito\Cryptography\HashAlgorithmCalcException("Test");
    }

    public function testKitoCryptographyHashAlgorithmNotFoundException()
    {        
        $this->expectException(Kito\Cryptography\HashAlgorithmNotFoundException::class);
        throw new Kito\Cryptography\HashAlgorithmNotFoundException("Test");
    }

    public function testKitoCryptographyInvalidHashValueException()
    {        
        $this->expectException(Kito\Cryptography\InvalidHashValueException::class);
        throw new Kito\Cryptography\InvalidHashValueException("Test");
    }

    public function testKitoException()
    {        
        $this->expectException(Kito\Exception::class);
        throw new Kito\Exception("Test");
    }

    public function testKitoExceptionsException()
    {        
        $this->expectException(Kito\Exceptions\Exception::class);
        throw new Kito\Exceptions\Exception("Test");
    }

    public function testKitoExceptionsIOException()
    {        
        $this->expectException(Kito\Exceptions\IOException::class);
        throw new Kito\Exceptions\IOException("Test");
    }

    public function testKitoExceptionsLibraryNotFoundException()
    {        
        $this->expectException(Kito\Exceptions\LibraryNotFoundException::class);
        throw new Kito\Exceptions\LibraryNotFoundException("Test");
    }

    public function testKitoExceptionsNotImplementedException()
    {        
        $this->expectException(Kito\Exceptions\NotImplementedException::class);
        throw new Kito\Exceptions\NotImplementedException("Test");
    }

    public function testKitoExceptionsStorageException()
    {        
        $this->expectException(Kito\Exceptions\Storage\Exception::class);
        throw new Kito\Exceptions\Storage\Exception("Test");
    }

    public function testKitoExceptionsStorageSQLCommandException()
    {        
        $this->expectException(Kito\Exceptions\Storage\SQL\CommandException::class);
        throw new Kito\Exceptions\Storage\SQL\CommandException("Test");
    }

    public function testKitoExceptionsStorageSQLConnectException()
    {        
        $this->expectException(Kito\Exceptions\Storage\SQL\ConnectException::class);
        throw new Kito\Exceptions\Storage\SQL\ConnectException("Test");
    }

    public function testKitoExceptionsStorageSQLConnectionClosedException()
    {        
        $this->expectException(Kito\Exceptions\Storage\SQL\ConnectionClosedException::class);
        throw new Kito\Exceptions\Storage\SQL\ConnectionClosedException("Test");
    }

    public function testKitoExceptionsStorageSQLCountException()
    {        
        $this->expectException(Kito\Exceptions\Storage\SQL\CountException::class);
        throw new Kito\Exceptions\Storage\SQL\CountException("Test");
    }

    public function testKitoExceptionsStorageSQLDeleteException()
    {        
        $this->expectException(Kito\Exceptions\Storage\SQL\DeleteException::class);
        throw new Kito\Exceptions\Storage\SQL\DeleteException("Test");
    }

    public function testKitoExceptionsStorageSQLException()
    {        
        $this->expectException(Kito\Exceptions\Storage\SQL\Exception::class);
        throw new Kito\Exceptions\Storage\SQL\Exception("Test");
    }

    public function testKitoExceptionsStorageSQLGetResultSetException()
    {        
        $this->expectException(Kito\Exceptions\Storage\SQL\GetResultSetException::class);
        throw new Kito\Exceptions\Storage\SQL\GetResultSetException("Test");
    }

    public function testKitoExceptionsStorageSQLInsertException()
    {        
        $this->expectException(Kito\Exceptions\Storage\SQL\InsertException::class);
        throw new Kito\Exceptions\Storage\SQL\InsertException("Test");
    }

    public function testKitoExceptionsStorageSQLMaxException()
    {        
        $this->expectException(Kito\Exceptions\Storage\SQL\MaxException::class);
        throw new Kito\Exceptions\Storage\SQL\MaxException("Test");
    }

    public function testKitoExceptionsStorageSQLMinException()
    {        
        $this->expectException(Kito\Exceptions\Storage\SQL\MinException::class);
        throw new Kito\Exceptions\Storage\SQL\MinException("Test");
    }

    public function testKitoExceptionsStorageSQLQueryException()
    {        
        $this->expectException(Kito\Exceptions\Storage\SQL\QueryException::class);
        throw new Kito\Exceptions\Storage\SQL\QueryException("Test");
    }

    public function testKitoExceptionsStorageSQLSelectDBException()
    {        
        $this->expectException(Kito\Exceptions\Storage\SQL\SelectDBException::class);
        throw new Kito\Exceptions\Storage\SQL\SelectDBException("Test");
    }

    public function testKitoExceptionsStorageSQLSelectException()
    {        
        $this->expectException(Kito\Exceptions\Storage\SQL\SelectException::class);
        throw new Kito\Exceptions\Storage\SQL\SelectException("Test");
    }

    public function testKitoExceptionsStorageSQLTooManyRowsException()
    {        
        $this->expectException(Kito\Exceptions\Storage\SQL\TooManyRowsException::class);
        throw new Kito\Exceptions\Storage\SQL\TooManyRowsException("Test");
    }

    public function testKitoExceptionsStorageSQLUpdateException()
    {        
        $this->expectException(Kito\Exceptions\Storage\SQL\UpdateException::class);
        throw new Kito\Exceptions\Storage\SQL\UpdateException("Test");
    }

    public function testKitoFileSystemCopyFileException()
    {        
        $this->expectException(Kito\FileSystem\CopyFileException::class);
        throw new Kito\FileSystem\CopyFileException("Test");
    }

    public function testKitoFileSystemCreateDirectoryException()
    {        
        $this->expectException(Kito\FileSystem\CreateDirectoryException::class);
        throw new Kito\FileSystem\CreateDirectoryException("Test");
    }

    public function testKitoFileSystemCreateFileException()
    {        
        $this->expectException(Kito\FileSystem\CreateFileException::class);
        throw new Kito\FileSystem\CreateFileException("Test");
    }

    public function testKitoFileSystemException()
    {        
        $this->expectException(Kito\FileSystem\Exception::class);
        throw new Kito\FileSystem\Exception("Test");
    }

    public function testKitoFileSystemIOException()
    {        
        $this->expectException(Kito\FileSystem\IOException::class);
        throw new Kito\FileSystem\IOException("Test");
    }

    public function testKitoFileSystemNotFoundException()
    {        
        $this->expectException(Kito\FileSystem\NotFoundException::class);
        throw new Kito\FileSystem\NotFoundException("Test");
    }

    public function testKitoFileSystemNotIsDirectoryException()
    {        
        $this->expectException(Kito\FileSystem\NotIsDirectoryException::class);
        throw new Kito\FileSystem\NotIsDirectoryException("Test");
    }

    public function testKitoFileSystemNotIsFileException()
    {        
        $this->expectException(Kito\FileSystem\NotIsFileException::class);
        throw new Kito\FileSystem\NotIsFileException("Test");
    }

    public function testKitoFileSystemNotIsLinkException()
    {        
        $this->expectException(Kito\FileSystem\NotIsLinkException::class);
        throw new Kito\FileSystem\NotIsLinkException("Test");
    }

    public function testKitoFileSystemNotIsReadableException()
    {        
        $this->expectException(Kito\FileSystem\NotIsReadableException::class);
        throw new Kito\FileSystem\NotIsReadableException("Test");
    }

    public function testKitoFileSystemNotIsWritableException()
    {        
        $this->expectException(Kito\FileSystem\NotIsWritableException::class);
        throw new Kito\FileSystem\NotIsWritableException("Test");
    }

    public function testKitoHTMLException()
    {        
        $this->expectException(Kito\HTML\Exception::class);
        throw new Kito\HTML\Exception("Test");
    }

    public function testKitoHTMLTagException()
    {        
        $this->expectException(Kito\HTML\Tag\Exception::class);
        throw new Kito\HTML\Tag\Exception("Test");
    }

    public function testKitoHTTPException()
    {        
        $this->expectException(Kito\HTTP\Exception::class);
        throw new Kito\HTTP\Exception("Test");
    }

    public function testKitoHTTPSessionException()
    {        
        $this->expectException(Kito\HTTP\Session\Exception::class);
        throw new Kito\HTTP\Session\Exception("Test");
    }

    public function testKitoInterfacesException()
    {        
        $this->expectException(Kito\Interfaces\Exception::class);
        throw new Kito\Interfaces\Exception("Test");
    }

    public function testKitoInterfacesStorageException()
    {        
        $this->expectException(Kito\Interfaces\Storage\Exception::class);
        throw new Kito\Interfaces\Storage\Exception("Test");
    }

    public function testKitoLabException()
    {        
        $this->expectException(Kito\Lab\Exception::class);
        throw new Kito\Lab\Exception("Test");
    }

    public function testKitoLegacyException()
    {        
        $this->expectException(Kito\Legacy\Exception::class);
        throw new Kito\Legacy\Exception("Test");
    }

    public function testKitoLegacyFrameworkException()
    {        
        $this->expectException(Kito\Legacy\Framework\Exception::class);
        throw new Kito\Legacy\Framework\Exception("Test");
    }

    public function testKitoLegacyFrameworkModulesDataBaseException()
    {        
        $this->expectException(Kito\Legacy\Framework\Modules\DataBase\Exception::class);
        throw new Kito\Legacy\Framework\Modules\DataBase\Exception("Test");
    }

    public function testKitoLegacyFrameworkModulesDataBaseImagesException()
    {        
        $this->expectException(Kito\Legacy\Framework\Modules\DataBase\Images\Exception::class);
        throw new Kito\Legacy\Framework\Modules\DataBase\Images\Exception("Test");
    }

    public function testKitoLegacyFrameworkModulesEditorException()
    {        
        $this->expectException(Kito\Legacy\Framework\Modules\Editor\Exception::class);
        throw new Kito\Legacy\Framework\Modules\Editor\Exception("Test");
    }

    public function testKitoLegacyFrameworkModulesEditorScriptsException()
    {        
        $this->expectException(Kito\Legacy\Framework\Modules\Editor\Scripts\Exception::class);
        throw new Kito\Legacy\Framework\Modules\Editor\Scripts\Exception("Test");
    }

    public function testKitoLegacyFrameworkModulesException()
    {        
        $this->expectException(Kito\Legacy\Framework\Modules\Exception::class);
        throw new Kito\Legacy\Framework\Modules\Exception("Test");
    }

    public function testKitoLegacyFrameworkModulesFormException()
    {        
        $this->expectException(Kito\Legacy\Framework\Modules\Form\Exception::class);
        throw new Kito\Legacy\Framework\Modules\Form\Exception("Test");
    }

    public function testKitoLegacyFrameworkModulesFormImagesException()
    {        
        $this->expectException(Kito\Legacy\Framework\Modules\Form\Images\Exception::class);
        throw new Kito\Legacy\Framework\Modules\Form\Images\Exception("Test");
    }

    public function testKitoLegacyFrameworkModulesFormScriptsException()
    {        
        $this->expectException(Kito\Legacy\Framework\Modules\Form\Scripts\Exception::class);
        throw new Kito\Legacy\Framework\Modules\Form\Scripts\Exception("Test");
    }

    public function testKitoLegacyFrameworkModulesHTMLDefaultTemplateException()
    {        
        $this->expectException(Kito\Legacy\Framework\Modules\HTML\DefaultTemplate\Exception::class);
        throw new Kito\Legacy\Framework\Modules\HTML\DefaultTemplate\Exception("Test");
    }

    public function testKitoLegacyFrameworkModulesHTMLException()
    {        
        $this->expectException(Kito\Legacy\Framework\Modules\HTML\Exception::class);
        throw new Kito\Legacy\Framework\Modules\HTML\Exception("Test");
    }

    public function testKitoLegacyFrameworkModulesHTMLImagesException()
    {        
        $this->expectException(Kito\Legacy\Framework\Modules\HTML\Images\Exception::class);
        throw new Kito\Legacy\Framework\Modules\HTML\Images\Exception("Test");
    }

    public function testKitoLegacyFrameworkModulesHTMLScriptsException()
    {        
        $this->expectException(Kito\Legacy\Framework\Modules\HTML\Scripts\Exception::class);
        throw new Kito\Legacy\Framework\Modules\HTML\Scripts\Exception("Test");
    }

    public function testKitoLegacyFrameworkModulesIDEException()
    {        
        $this->expectException(Kito\Legacy\Framework\Modules\IDE\Exception::class);
        throw new Kito\Legacy\Framework\Modules\IDE\Exception("Test");
    }

    public function testKitoLegacyFrameworkModulesIDEImagesException()
    {        
        $this->expectException(Kito\Legacy\Framework\Modules\IDE\Images\Exception::class);
        throw new Kito\Legacy\Framework\Modules\IDE\Images\Exception("Test");
    }

    public function testKitoLegacyFrameworkModulesLoggerException()
    {        
        $this->expectException(Kito\Legacy\Framework\Modules\Logger\Exception::class);
        throw new Kito\Legacy\Framework\Modules\Logger\Exception("Test");
    }

    public function testKitoLegacyFrameworkModulesLoggerImagesException()
    {        
        $this->expectException(Kito\Legacy\Framework\Modules\Logger\Images\Exception::class);
        throw new Kito\Legacy\Framework\Modules\Logger\Images\Exception("Test");
    }

    public function testKitoLegacyFrameworkModulesMapException()
    {        
        $this->expectException(Kito\Legacy\Framework\Modules\Map\Exception::class);
        throw new Kito\Legacy\Framework\Modules\Map\Exception("Test");
    }

    public function testKitoLegacyFrameworkModulesMapScriptsException()
    {        
        $this->expectException(Kito\Legacy\Framework\Modules\Map\Scripts\Exception::class);
        throw new Kito\Legacy\Framework\Modules\Map\Scripts\Exception("Test");
    }

    public function testKitoLegacyFrameworkModulesMySqlException()
    {        
        $this->expectException(Kito\Legacy\Framework\Modules\MySql\Exception::class);
        throw new Kito\Legacy\Framework\Modules\MySql\Exception("Test");
    }

    public function testKitoLegacyFrameworkModulesMySqlImagesException()
    {        
        $this->expectException(Kito\Legacy\Framework\Modules\MySql\Images\Exception::class);
        throw new Kito\Legacy\Framework\Modules\MySql\Images\Exception("Test");
    }

    public function testKitoLegacyFrameworkModulesRssException()
    {        
        $this->expectException(Kito\Legacy\Framework\Modules\Rss\Exception::class);
        throw new Kito\Legacy\Framework\Modules\Rss\Exception("Test");
    }

    public function testKitoLegacyFrameworkModulesRssImagesException()
    {        
        $this->expectException(Kito\Legacy\Framework\Modules\Rss\Images\Exception::class);
        throw new Kito\Legacy\Framework\Modules\Rss\Images\Exception("Test");
    }

    public function testKitoLegacyFrameworkModulesZonesException()
    {        
        $this->expectException(Kito\Legacy\Framework\Modules\Zones\Exception::class);
        throw new Kito\Legacy\Framework\Modules\Zones\Exception("Test");
    }

    public function testKitoLegacyFrameworkModulesZonesImagesException()
    {        
        $this->expectException(Kito\Legacy\Framework\Modules\Zones\Images\Exception::class);
        throw new Kito\Legacy\Framework\Modules\Zones\Images\Exception("Test");
    }

    public function testKitoLegacyFrameworkSystemException()
    {        
        $this->expectException(Kito\Legacy\Framework\System\Exception::class);
        throw new Kito\Legacy\Framework\System\Exception("Test");
    }

    public function testKitoLegacyFrameworkSystemImagesException()
    {        
        $this->expectException(Kito\Legacy\Framework\System\Images\Exception::class);
        throw new Kito\Legacy\Framework\System\Images\Exception("Test");
    }

    public function testKitoLegacyioException()
    {        
        $this->expectException(Kito\Legacy\io\Exception::class);
        throw new Kito\Legacy\io\Exception("Test");
    }

    public function testKitoLegacyionetworkException()
    {        
        $this->expectException(Kito\Legacy\io\network\Exception::class);
        throw new Kito\Legacy\io\network\Exception("Test");
    }

    public function testKitoLegacyionetworkhttpException()
    {        
        $this->expectException(Kito\Legacy\io\network\http\Exception::class);
        throw new Kito\Legacy\io\network\http\Exception("Test");
    }

    public function testKitoLegacystorageException()
    {        
        $this->expectException(Kito\Legacy\storage\Exception::class);
        throw new Kito\Legacy\storage\Exception("Test");
    }

    public function testKitoLegacystoragedbException()
    {        
        $this->expectException(Kito\Legacy\storage\db\Exception::class);
        throw new Kito\Legacy\storage\db\Exception("Test");
    }

    public function testKitoLegacystoragedbrelationalException()
    {        
        $this->expectException(Kito\Legacy\storage\db\relational\Exception::class);
        throw new Kito\Legacy\storage\db\relational\Exception("Test");
    }

    public function testKitoLoaderException()
    {        
        $this->expectException(Kito\Loader\Exception::class);
        throw new Kito\Loader\Exception("Test");
    }

    public function testKitoMathException()
    {        
        $this->expectException(Kito\Math\Exception::class);
        throw new Kito\Math\Exception("Test");
    }

    public function testKitoNetworkException()
    {        
        $this->expectException(Kito\Network\Exception::class);
        throw new Kito\Network\Exception("Test");
    }

    public function testKitoRouterException()
    {        
        $this->expectException(Kito\Router\Exception::class);
        throw new Kito\Router\Exception("Test");
    }

    public function testKitoStorageDataBaseException()
    {        
        $this->expectException(Kito\Storage\DataBase\Exception::class);
        throw new Kito\Storage\DataBase\Exception("Test");
    }

    public function testKitoStorageDataBaseSubSystemDataNException()
    {        
        $this->expectException(Kito\Storage\DataBase\SubSystem\DataN\Exception::class);
        throw new Kito\Storage\DataBase\SubSystem\DataN\Exception("Test");
    }

    public function testKitoStorageDataBaseSubSystemException()
    {        
        $this->expectException(Kito\Storage\DataBase\SubSystem\Exception::class);
        throw new Kito\Storage\DataBase\SubSystem\Exception("Test");
    }

    public function testKitoStorageDataBaseSubSystemQueueException()
    {        
        $this->expectException(Kito\Storage\DataBase\SubSystem\Queue\Exception::class);
        throw new Kito\Storage\DataBase\SubSystem\Queue\Exception("Test");
    }

    public function testKitoStorageDataBaseSubSystemQueueKeyValueException()
    {        
        $this->expectException(Kito\Storage\DataBase\SubSystem\Queue\KeyValue\Exception::class);
        throw new Kito\Storage\DataBase\SubSystem\Queue\KeyValue\Exception("Test");
    }

    public function testKitoStorageDataBaseSubSystemTreeCommonException()
    {        
        $this->expectException(Kito\Storage\DataBase\SubSystem\Tree\Common\Exception::class);
        throw new Kito\Storage\DataBase\SubSystem\Tree\Common\Exception("Test");
    }

    public function testKitoStorageDataBaseSubSystemTreeException()
    {        
        $this->expectException(Kito\Storage\DataBase\SubSystem\Tree\Exception::class);
        throw new Kito\Storage\DataBase\SubSystem\Tree\Exception("Test");
    }

    public function testKitoStorageDataBaseSubSystemTreeNodeException()
    {        
        $this->expectException(Kito\Storage\DataBase\SubSystem\Tree\Node\Exception::class);
        throw new Kito\Storage\DataBase\SubSystem\Tree\Node\Exception("Test");
    }

    public function testKitoStorageDataBaseSubSystemTreeStandardAddressException()
    {        
        $this->expectException(Kito\Storage\DataBase\SubSystem\Tree\Standard\Address\Exception::class);
        throw new Kito\Storage\DataBase\SubSystem\Tree\Standard\Address\Exception("Test");
    }

    public function testKitoStorageDataBaseSubSystemTreeStandardException()
    {        
        $this->expectException(Kito\Storage\DataBase\SubSystem\Tree\Standard\Exception::class);
        throw new Kito\Storage\DataBase\SubSystem\Tree\Standard\Exception("Test");
    }

    public function testKitoStorageDataBaseSubSystemTreeStandardMessagesException()
    {        
        $this->expectException(Kito\Storage\DataBase\SubSystem\Tree\Standard\Messages\Exception::class);
        throw new Kito\Storage\DataBase\SubSystem\Tree\Standard\Messages\Exception("Test");
    }

    public function testKitoStorageDataBaseSubSystemTreeZoneException()
    {        
        $this->expectException(Kito\Storage\DataBase\SubSystem\Tree\Zone\Exception::class);
        throw new Kito\Storage\DataBase\SubSystem\Tree\Zone\Exception("Test");
    }

    public function testKitoStorageException()
    {        
        $this->expectException(Kito\Storage\Exception::class);
        throw new Kito\Storage\Exception("Test");
    }

    public function testKitoStorageFileSystemException()
    {        
        $this->expectException(Kito\Storage\FileSystem\Exception::class);
        throw new Kito\Storage\FileSystem\Exception("Test");
    }

    public function testKitoStorageFileSystemFileException()
    {        
        $this->expectException(Kito\Storage\FileSystem\File\Exception::class);
        throw new Kito\Storage\FileSystem\File\Exception("Test");
    }

    public function testKitoStringException()
    {        
        $this->expectException(Kito\String\Exception::class);
        throw new Kito\String\Exception("Test");
    }

    public function testKitoTypeException()
    {        
        $this->expectException(Kito\Type\Exception::class);
        throw new Kito\Type\Exception("Test");
    }
}