<?php
use PHPUnit\Framework\TestCase;

class ExceptionTest extends TestCase
{
    public function testKitoCryptographyException()
    {        
        $this->expectException(Kito\Cryptography\Exception::class);
        throw new Kito\Cryptography\Exception("Test");
    }

    public function testKitoException()
    {        
        $this->expectException(Kito\Exception::class);
        throw new Kito\Exception("Test");
    }

    public function testKitoExceptionsCryptographyException()
    {        
        $this->expectException(Kito\Exceptions\Cryptography\Exception::class);
        throw new Kito\Exceptions\Cryptography\Exception("Test");
    }

    public function testKitoExceptionsCryptographyHashAlgorithmCalcException()
    {        
        $this->expectException(Kito\Exceptions\Cryptography\HashAlgorithmCalcException::class);
        throw new Kito\Exceptions\Cryptography\HashAlgorithmCalcException("Test");
    }

    public function testKitoExceptionsCryptographyHashAlgorithmNotFoundException()
    {        
        $this->expectException(Kito\Exceptions\Cryptography\HashAlgorithmNotFoundException::class);
        throw new Kito\Exceptions\Cryptography\HashAlgorithmNotFoundException("Test");
    }

    public function testKitoExceptionsCryptographyInvalidHashValueException()
    {        
        $this->expectException(Kito\Exceptions\Cryptography\InvalidHashValueException::class);
        throw new Kito\Exceptions\Cryptography\InvalidHashValueException("Test");
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

    public function testKitoExceptionsStorageFileSystemCopyFileException()
    {        
        $this->expectException(Kito\Exceptions\Storage\FileSystem\CopyFileException::class);
        throw new Kito\Exceptions\Storage\FileSystem\CopyFileException("Test");
    }

    public function testKitoExceptionsStorageFileSystemCreateDirectoryException()
    {        
        $this->expectException(Kito\Exceptions\Storage\FileSystem\CreateDirectoryException::class);
        throw new Kito\Exceptions\Storage\FileSystem\CreateDirectoryException("Test");
    }

    public function testKitoExceptionsStorageFileSystemCreateFileException()
    {        
        $this->expectException(Kito\Exceptions\Storage\FileSystem\CreateFileException::class);
        throw new Kito\Exceptions\Storage\FileSystem\CreateFileException("Test");
    }

    public function testKitoExceptionsStorageFileSystemException()
    {        
        $this->expectException(Kito\Exceptions\Storage\FileSystem\Exception::class);
        throw new Kito\Exceptions\Storage\FileSystem\Exception("Test");
    }

    public function testKitoExceptionsStorageFileSystemIOException()
    {        
        $this->expectException(Kito\Exceptions\Storage\FileSystem\IOException::class);
        throw new Kito\Exceptions\Storage\FileSystem\IOException("Test");
    }

    public function testKitoExceptionsStorageFileSystemNotFoundException()
    {        
        $this->expectException(Kito\Exceptions\Storage\FileSystem\NotFoundException::class);
        throw new Kito\Exceptions\Storage\FileSystem\NotFoundException("Test");
    }

    public function testKitoExceptionsStorageFileSystemNotIsDirectoryException()
    {        
        $this->expectException(Kito\Exceptions\Storage\FileSystem\NotIsDirectoryException::class);
        throw new Kito\Exceptions\Storage\FileSystem\NotIsDirectoryException("Test");
    }

    public function testKitoExceptionsStorageFileSystemNotIsFileException()
    {        
        $this->expectException(Kito\Exceptions\Storage\FileSystem\NotIsFileException::class);
        throw new Kito\Exceptions\Storage\FileSystem\NotIsFileException("Test");
    }

    public function testKitoExceptionsStorageFileSystemNotIsLinkException()
    {        
        $this->expectException(Kito\Exceptions\Storage\FileSystem\NotIsLinkException::class);
        throw new Kito\Exceptions\Storage\FileSystem\NotIsLinkException("Test");
    }

    public function testKitoExceptionsStorageFileSystemNotIsReadableException()
    {        
        $this->expectException(Kito\Exceptions\Storage\FileSystem\NotIsReadableException::class);
        throw new Kito\Exceptions\Storage\FileSystem\NotIsReadableException("Test");
    }

    public function testKitoExceptionsStorageFileSystemNotIsWritableException()
    {        
        $this->expectException(Kito\Exceptions\Storage\FileSystem\NotIsWritableException::class);
        throw new Kito\Exceptions\Storage\FileSystem\NotIsWritableException("Test");
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

    public function testKitoHTMLException()
    {        
        $this->expectException(Kito\HTML\Exception::class);
        throw new Kito\HTML\Exception("Test");
    }

    public function testKitoHTTPException()
    {        
        $this->expectException(Kito\HTTP\Exception::class);
        throw new Kito\HTTP\Exception("Test");
    }

    public function testKitoStorageDataBaseException()
    {        
        $this->expectException(Kito\Storage\DataBase\Exception::class);
        throw new Kito\Storage\DataBase\Exception("Test");
    }

    public function testKitoStorageException()
    {        
        $this->expectException(Kito\Storage\Exception::class);
        throw new Kito\Storage\Exception("Test");
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