<?php

namespace Nuwave\Lighthouse\Support\Http\Responses;

abstract class Stream
{
    /**
     * Get error from chunk if it exists.
     *
     * @param string $path
     * @param array  $data
     *
     * @return array|null
     */
    protected function chunkError(string $path, array $data)
    {
        if (! isset($data['errors'])) {
            return null;
        }

        return collect($data['errors'])->filter(function ($error) use ($path) {
            return starts_with(implode('.', $error['path']), $path);
        })->values()->toArray();
    }
}
