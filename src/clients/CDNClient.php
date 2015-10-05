<?php

namespace GErcoli\CDN\Clients;

abstract class CDNClient
{
    /**
     * The CDN client.
     * @var Object
     */
    protected $client;

    /**
     * The CDN client options.
     * @var array
     */
    protected $options;

    /**
     * Create a CDNClient object using dependancy injection
     * @param Object $client The CDN client that is capable of file transfers to the CDN.
     */
    public function __construct(Object $client, array $options = array())
    {
        $this->client = $client;
        $this->options = $options;
    }

    /**
     * Download files FROM the CDN client to the destination directory.
     * @param  string|array $patternOrigin The file pattern(s) to download.
     * @param  string       $destination   The directory to place the newly downloaded files in.
     * @param  array        $options       An array of options for the client.
     * @return CDNClient
     */
    public abstract function downloadFiles($patternOrigin, $destination, array $options = array());

    /**
     * Upload files that match the given pattern TO the destination directory on the CDN.
     * @param  string|array $patternOrigin  The file pattern(s) to upload.
     * @param  string       $destination    The directory to place the uploaded files in (on the CDN).
     * @param  array        $options        An array of options for the client.
     * @return CDNClient
     */
    public abstract function uploadFiles($patternOrigin, $destination, array $options = array());

    /**
     * Deletes fils on the CDN that match the given pattern(s).
     * @param  string|array $patternOrigin  The file pattern(s) to delete.
     * @param  array        $options        An array of options for the client.
     * @return CDNClient
     */
    public abstract function deleteFiles($patternOrigin, array $options = array());

    /**
     * Sets file permissions on the CDN client.
     * @param string|array  $filePattern    The pattern to match against.
     * @param array         $options        An array of options for the client.
     * @return CDNClient
     */
    public abstract function setPermissions($filePattern, array $options = array());


}
