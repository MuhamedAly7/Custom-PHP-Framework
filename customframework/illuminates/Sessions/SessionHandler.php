<?php

namespace Illuminates\Sessions;


class SessionHandler implements \SessionHandlerInterface
{
    public function __construct(public $save_path, public $prefix)
    {
        
    }
    
    /**
     * close
     *
     * @return bool
     */
    public function close(): bool
    {
        return true;   
    }
    
    /**
     * destroy
     *
     * @param  mixed $id
     * @return bool
     */
    public function destroy(string $id): bool
    {
        $file = $this->save_path . DIRECTORY_SEPARATOR . $this->prefix . '_' . $id;

        if (file_exists($file)) {
            unlink($file);
        }
        return true;
    }
    
    /**
     * gc
     *
     * @param  mixed $max_lifetime
     * @return int
     */
    public function gc(int $max_lifetime): int|false
    {
        foreach (glob($this->save_path.'/'.$this->prefix.'_*') as $file) {
            if ((filemtime($file) + $max_lifetime) < time() && file_exists($file)) {
                unlink($file);
            }
        }
        return true;
    }
    
    /**
     * open
     *
     * @param  mixed $path
     * @param  mixed $name
     * @return bool
     */
    public function open(string $path, string $name): bool
    {
        if (!is_dir($this->save_path)) {
            mkdir($this->save_path, 0755);
        }
        return true;
    }

        
    /**
     * read
     *
     * @param  mixed $id
     * @return string
     */
    public function read(string $id): string|false
    {
        $file = $this->save_path.'/'.$this->prefix.'_'.$id;
        return file_exists($file) ? file_get_contents($file) : '';
    }

        
    /**
     * write
     *
     * @param  mixed $id
     * @param  mixed $data
     * @return bool
     */
    public function write(string $id, string $data): bool
    {
        return file_put_contents($this->save_path.'/'.$this->prefix.'_'.$id, $data) !== false;
    }

}