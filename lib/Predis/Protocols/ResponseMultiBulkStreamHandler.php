<?php

namespace Predis\Protocols;

use Predis\Utils;
use Predis\ProtocolException;
use Predis\Network\IConnectionComposable;
use Predis\Iterators\MultiBulkResponseSimple;

class ResponseMultiBulkStreamHandler implements IResponseHandler {
    public function handle(IConnectionComposable $connection, $lengthString) {
        $length = (int) $lengthString;
        if ($length != $lengthString) {
            Utils::onCommunicationException(new ProtocolException(
                $connection, "Cannot parse '$length' as data length"
            ));
        }
        return new MultiBulkResponseSimple($connection, $length);
    }
}
