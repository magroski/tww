<?php

namespace Tww;

class Client
{
    /** @var string */
    private $credentials;

    public function __construct(string $twwUser, string $twwPass)
    {
        $this->credentials = ['NumUsu' => $twwUser, 'Senha' => $twwPass];
    }

    /**
     * @return string|false
     */
    public function send(string $to, string $text, ?string $id = null)
    {
        $phone = preg_replace("/[(,),\-,\s]/", "", $to);
        $phone = preg_replace('/^' . preg_quote('+55', '/') . '/', '', $phone);

        $text      = $this->convertToAsciiSet($text);
        $url       = 'http://webservices.twwwireless.com.br/reluzcap/wsreluzcap.asmx/EnviaSMS';
        $queryData = array_merge($this->credentials, ['Celular' => $phone, 'Mensagem' => $text]);

        if (!empty($id)) {
            $queryData['SeuNum'] = $id;
        } else {
            $queryData['SeuNum'] = 0;
        }

        $options = [
            'http' => [
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($queryData),
            ],
        ];
        $context = stream_context_create($options);

        return file_get_contents($url, false, $context);
    }

    /**
     * Swap incompatible characters with compatible ones.
     * Ex: Swaps [ã | à | á] with [a]
     */
    private function convertToAsciiSet(string $text)
    {
        $unwanted_array = [
            'Š' => 'S',
            'š' => 's',
            'Ž' => 'Z',
            'ž' => 'z',
            'À' => 'A',
            'Á' => 'A',
            'Â' => 'A',
            'Ã' => 'A',
            'Ä' => 'A',
            'Å' => 'A',
            'Æ' => 'A',
            'Ç' => 'C',
            'È' => 'E',
            'É' => 'E',
            'Ê' => 'E',
            'Ë' => 'E',
            'Ì' => 'I',
            'Í' => 'I',
            'Î' => 'I',
            'Ï' => 'I',
            'Ñ' => 'N',
            'Ò' => 'O',
            'Ó' => 'O',
            'Ô' => 'O',
            'Õ' => 'O',
            'Ö' => 'O',
            'Ø' => 'O',
            'Ù' => 'U',
            'Ú' => 'U',
            'Û' => 'U',
            'Ü' => 'U',
            'Ý' => 'Y',
            'Þ' => 'B',
            'ß' => 'Ss',
            'à' => 'a',
            'á' => 'a',
            'â' => 'a',
            'ã' => 'a',
            'ä' => 'a',
            'å' => 'a',
            'æ' => 'a',
            'ç' => 'c',
            'è' => 'e',
            'é' => 'e',
            'ê' => 'e',
            'ë' => 'e',
            'ì' => 'i',
            'í' => 'i',
            'î' => 'i',
            'ï' => 'i',
            'ð' => 'o',
            'ñ' => 'n',
            'ò' => 'o',
            'ó' => 'o',
            'ô' => 'o',
            'õ' => 'o',
            'ö' => 'o',
            'ø' => 'o',
            'ù' => 'u',
            'ú' => 'u',
            'û' => 'u',
            'ý' => 'y',
            'þ' => 'b',
            'ÿ' => 'y',
        ];

        return strtr($text, $unwanted_array);
    }
}
