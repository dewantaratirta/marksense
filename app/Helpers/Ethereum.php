<?php

/** No License - https://github.com/marcmasmar/php-ecrecover-personal **/

/**
 * This file contains helper functions for interacting with the Ethereum blockchain.
 * 
 * @file /e:/htdocs8/marksense/app/Helpers/Ethereum.php
 * 
 * @param string $msg original message
 * @param string $signed signed message
 * @return string
 */
function fromMessage(string $msg, string $signed): string
{
    $personal_prefix_msg = "\x19Ethereum Signed Message:\n" . strlen($msg) . $msg;
    return fromMessageRaw($personal_prefix_msg, $signed);
}

function fromMessageRaw($msg, $signed): string
{
    $hex = keccak256s($msg);
    $signed = substr($signed, 2);

    $rHex = substr($signed, 0, 64);
    $sHex = substr($signed, 64, 64);
    $vValue = hexdec(substr($signed, 128, 2));

    $messageHex = substr($hex, 2);
    $messageGmp = gmp_init($messageHex, 16);

    $r = $rHex;
    $s = $sHex;
    $v = $vValue;

    $rGmp = gmp_init($r, 16);
    $sGmp = gmp_init($s, 16);

    if ($v !== 27 && $v !== 28) {
        $v += 27;
    }

    $recovery = $v - 27;
    if ($recovery !== 0 && $recovery !== 1) {
        throw new \Exception('Invalid signature v value');
    }

    $publicKey = recoverPublicKey($rGmp, $sGmp, $messageGmp, $recovery);
    $publicKeyString = $publicKey['x'] . $publicKey['y'];

    $hash = keccak256s(hex2bin($publicKeyString));
    $truncatedHash = substr($hash, -40);

    return '0x' . $truncatedHash;
}

function keccak256s($str)
{
    return '0x' . Keccak2::hash($str, 256);
}

/**
 *  A bit gpt unrolled version of the original author kornruner/keccak 
 */
final class Keccak2
{
    private const KECCAK_ROUNDS = 24;
    private const LFSR = 0x01;
    private const ENCODING = '8bit';
    private const keccakf_rotc = [1, 3, 6, 10, 15, 21, 28, 36, 45, 55, 2, 14, 27, 41, 56, 8, 25, 43, 62, 18, 39, 61, 20, 44];
    private const keccakf_piln = [10, 7, 11, 17, 18, 3, 5, 16, 8, 21, 24, 4, 15, 23, 19, 13, 12, 2, 20, 14, 22, 9, 6, 1];
    private const keccakf_rndc = [
        [0x00000000, 0x00000001],
        [0x00000000, 0x00008082],
        [0x80000000, 0x0000808a],
        [0x80000000, 0x80008000],
        [0x00000000, 0x0000808b],
        [0x00000000, 0x80000001],
        [0x80000000, 0x80008081],
        [0x80000000, 0x00008009],
        [0x00000000, 0x0000008a],
        [0x00000000, 0x00000088],
        [0x00000000, 0x80008009],
        [0x00000000, 0x8000000a],
        [0x00000000, 0x8000808b],
        [0x80000000, 0x0000008b],
        [0x80000000, 0x00008089],
        [0x80000000, 0x00008003],
        [0x80000000, 0x00008002],
        [0x80000000, 0x00000080],
        [0x00000000, 0x0000800a],
        [0x80000000, 0x8000000a],
        [0x80000000, 0x80008081],
        [0x80000000, 0x00008080],
        [0x00000000, 0x80000001],
        [0x80000000, 0x80008008]
    ];

    private static function keccakf64(&$st, $rounds): void
    {

        $bc = [];
        for ($round = 0; $round < $rounds; $round++) {

            // Theta
            $bc[0] = [
                $st[0][0] ^ $st[5][0] ^ $st[10][0] ^ $st[15][0] ^ $st[20][0],
                $st[0][1] ^ $st[5][1] ^ $st[10][1] ^ $st[15][1] ^ $st[20][1]
            ];
            $bc[1] = [
                $st[1][0] ^ $st[6][0] ^ $st[11][0] ^ $st[16][0] ^ $st[21][0],
                $st[1][1] ^ $st[6][1] ^ $st[11][1] ^ $st[16][1] ^ $st[21][1]
            ];
            $bc[2] = [
                $st[2][0] ^ $st[7][0] ^ $st[12][0] ^ $st[17][0] ^ $st[22][0],
                $st[2][1] ^ $st[7][1] ^ $st[12][1] ^ $st[17][1] ^ $st[22][1]
            ];
            $bc[3] = [
                $st[3][0] ^ $st[8][0] ^ $st[13][0] ^ $st[18][0] ^ $st[23][0],
                $st[3][1] ^ $st[8][1] ^ $st[13][1] ^ $st[18][1] ^ $st[23][1]
            ];
            $bc[4] = [
                $st[4][0] ^ $st[9][0] ^ $st[14][0] ^ $st[19][0] ^ $st[24][0],
                $st[4][1] ^ $st[9][1] ^ $st[14][1] ^ $st[19][1] ^ $st[24][1]
            ];
            /////
            $t1_0 = $bc[4][0] ^ (($bc[1][0] << 1) | ($bc[1][1] >> 31)) & 0xFFFFFFFF;
            $t1_1 = $bc[4][1] ^ (($bc[1][1] << 1) | ($bc[1][0] >> 31)) & 0xFFFFFFFF;
            $st[0][0] ^= $t1_0;
            $st[0][1] ^= $t1_1;
            $st[5][0] ^= $t1_0;
            $st[5][1] ^= $t1_1;
            $st[10][0] ^= $t1_0;
            $st[10][1] ^= $t1_1;
            $st[15][0] ^= $t1_0;
            $st[15][1] ^= $t1_1;
            $st[20][0] ^= $t1_0;
            $st[20][1] ^= $t1_1;

            $t2_0 = $bc[0][0] ^ (($bc[2][0] << 1) | ($bc[2][1] >> 31)) & 0xFFFFFFFF;
            $t2_1 = $bc[0][1] ^ (($bc[2][1] << 1) | ($bc[2][0] >> 31)) & 0xFFFFFFFF;
            $st[1][0] ^= $t2_0;
            $st[1][1] ^= $t2_1;
            $st[6][0] ^= $t2_0;
            $st[6][1] ^= $t2_1;
            $st[11][0] ^= $t2_0;
            $st[11][1] ^= $t2_1;
            $st[16][0] ^= $t2_0;
            $st[16][1] ^= $t2_1;
            $st[21][0] ^= $t2_0;
            $st[21][1] ^= $t2_1;

            $t3_0 = $bc[1][0] ^ (($bc[3][0] << 1) | ($bc[3][1] >> 31)) & 0xFFFFFFFF;
            $t3_1 = $bc[1][1] ^ (($bc[3][1] << 1) | ($bc[3][0] >> 31)) & 0xFFFFFFFF;
            $st[2][0] ^= $t3_0;
            $st[2][1] ^= $t3_1;
            $st[7][0] ^= $t3_0;
            $st[7][1] ^= $t3_1;
            $st[12][0] ^= $t3_0;
            $st[12][1] ^= $t3_1;
            $st[17][0] ^= $t3_0;
            $st[17][1] ^= $t3_1;
            $st[22][0] ^= $t3_0;
            $st[22][1] ^= $t3_1;

            $t4_0 = $bc[2][0] ^ (($bc[4][0] << 1) | ($bc[4][1] >> 31)) & 0xFFFFFFFF;
            $t4_1 = $bc[2][1] ^ (($bc[4][1] << 1) | ($bc[4][0] >> 31)) & 0xFFFFFFFF;
            $st[3][0] ^= $t4_0;
            $st[3][1] ^= $t4_1;
            $st[8][0] ^= $t4_0;
            $st[8][1] ^= $t4_1;
            $st[13][0] ^= $t4_0;
            $st[13][1] ^= $t4_1;
            $st[18][0] ^= $t4_0;
            $st[18][1] ^= $t4_1;
            $st[23][0] ^= $t4_0;
            $st[23][1] ^= $t4_1;

            $t5_0 = $bc[3][0] ^ (($bc[0][0] << 1) | ($bc[0][1] >> 31)) & 0xFFFFFFFF;
            $t5_1 = $bc[3][1] ^ (($bc[0][1] << 1) | ($bc[0][0] >> 31)) & 0xFFFFFFFF;
            $st[4][0] ^= $t5_0;
            $st[4][1] ^= $t5_1;
            $st[9][0] ^= $t5_0;
            $st[9][1] ^= $t5_1;
            $st[14][0] ^= $t5_0;
            $st[14][1] ^= $t5_1;
            $st[19][0] ^= $t5_0;
            $st[19][1] ^= $t5_1;
            $st[24][0] ^= $t5_0;
            $st[24][1] ^= $t5_1;

            ////

            // Rho Pi
            $t = $st[1];
            for ($i = 0; $i < 24; $i++) {
                $j = self::keccakf_piln[$i];

                $bc[0] = $st[$j];

                $n = self::keccakf_rotc[$i];
                $hi = $t[0];
                $lo = $t[1];
                if ($n >= 32) {
                    $n -= 32;
                    $hi = $t[1];
                    $lo = $t[0];
                }

                $st[$j] = [
                    (($hi << $n) | ($lo >> (32 - $n))) & (0xFFFFFFFF),
                    (($lo << $n) | ($hi >> (32 - $n))) & (0xFFFFFFFF)
                ];

                $t = $bc[0];
            }

            //  Chi
            for ($j = 0; $j < 25; $j += 5) {
                $bc0 = $st[$j];
                $bc1 = $st[$j + 1];
                $bc2 = $st[$j + 2];
                $bc3 = $st[$j + 3];
                $bc4 = $st[$j + 4];

                $st[$j] = [
                    $bc0[0] ^ (~$bc1[0] & $bc2[0]),
                    $bc0[1] ^ (~$bc1[1] & $bc2[1])
                ];
                $st[$j + 1] = [
                    $bc1[0] ^ (~$bc2[0] & $bc3[0]),
                    $bc1[1] ^ (~$bc2[1] & $bc3[1])
                ];
                $st[$j + 2] = [
                    $bc2[0] ^ (~$bc3[0] & $bc4[0]),
                    $bc2[1] ^ (~$bc3[1] & $bc4[1])
                ];
                $st[$j + 3] = [
                    $bc3[0] ^ (~$bc4[0] & $bc0[0]),
                    $bc3[1] ^ (~$bc4[1] & $bc0[1])
                ];
                $st[$j + 4] = [
                    $bc4[0] ^ (~$bc0[0] & $bc1[0]),
                    $bc4[1] ^ (~$bc0[1] & $bc1[1])
                ];
            }

            // Iota
            $st[0] = [
                $st[0][0] ^ self::keccakf_rndc[$round][0],
                $st[0][1] ^ self::keccakf_rndc[$round][1]
            ];
        }
    }

    private static function keccak64($in_raw, int $capacity, int $outputlength, $suffix, bool $raw_output): string
    {
        $capacity /= 8;

        $inlen = mb_strlen($in_raw, self::ENCODING);

        $rsiz = 200 - 2 * $capacity;
        $rsizw = $rsiz / 8;

        $st = [];
        for ($i = 0; $i < 25; $i++) {
            $st[] = [0, 0];
        }

        for ($in_t = 0; $inlen >= $rsiz; $inlen -= $rsiz, $in_t += $rsiz) {
            for ($i = 0; $i < $rsizw; $i++) {
                $t = unpack('V*', mb_substr($in_raw, intval($i * 8 + $in_t), 8, self::ENCODING));

                $st[$i] = [
                    $st[$i][0] ^ $t[2],
                    $st[$i][1] ^ $t[1]
                ];
            }

            self::keccakf64($st, self::KECCAK_ROUNDS);
        }

        $temp = mb_substr($in_raw, (int) $in_t, (int) $inlen, self::ENCODING);
        $temp = str_pad($temp, (int) $rsiz, "\x0", STR_PAD_RIGHT);
        $temp = substr_replace($temp, chr($suffix), $inlen, 1);
        $temp = substr_replace($temp, chr(ord($temp[intval($rsiz - 1)]) | 0x80), $rsiz - 1, 1);

        for ($i = 0; $i < $rsizw; $i++) {
            $t = unpack('V*', mb_substr($temp, $i * 8, 8, self::ENCODING));

            $st[$i] = [
                $st[$i][0] ^ $t[2],
                $st[$i][1] ^ $t[1]
            ];
        }

        self::keccakf64($st, self::KECCAK_ROUNDS);

        $out = '';
        for ($i = 0; $i < 25; $i++) {
            $out .= $t = pack('V*', $st[$i][1], $st[$i][0]);
        }
        $r = mb_substr($out, 0, intval($outputlength / 8), self::ENCODING);

        return $raw_output ? $r : bin2hex($r);
    }
    public static function hash($in, int $mdlen, bool $raw_output = false): string
    {
        if (!in_array($mdlen, [224, 256, 384, 512], true)) {
            throw new \Exception('Unsupported Keccak Hash output size.');
        }

        return self::keccak64($in, $mdlen, $mdlen, self::LFSR, $raw_output);
    }
}

/**
 *  Extraction and a bit gpt unroll of the original project CryptoCurrencyPHP 
 */
function recoverPublicKey($R, $S, $hash, $recoveryFlags)
{

    $a = gmp_init('0', 10);
    $b = gmp_init('7', 10);
    $G = [
        'x' => gmp_init('55066263022277343669578718895168534326250603453777594175500187360389116729240'),
        'y' => gmp_init('32670510020758816978083085130507043184471273380659243275938904335757337482424')
    ];
    $n = gmp_init('FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFEBAAEDCE6AF48A03BBFD25E8CD0364141', 16);
    $p = gmp_init('FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFEFFFFFC2F', 16);

    $isYEven = ($recoveryFlags & 1) != 0;
    $isSecondKey = ($recoveryFlags & 2) != 0;

    $e = gmp_strval($hash, 16);
    $s = gmp_strval($S, 16);

    $p_over_four = gmp_div(gmp_add($p, 1), 4);


    if (!$isSecondKey) {
        $x = $R;
    } else {
        $x = gmp_add($R, $n);
    }

    $alpha = gmp_mod(gmp_add(gmp_add(gmp_pow($x, 3), gmp_mul($a, $x)), $b), $p);
    $beta = gmp_strval(gmp_powm($alpha, $p_over_four, $p));

    $y = isEvenNumber($beta) == $isYEven ? gmp_sub($p, $beta) : gmp_init($beta);

    $Rpt = ['x' => $x, 'y' => $y];

    $rInv = gmp_strval(gmp_invert($R, $n), 16);
    $eGNeg = negatePoint(mulPoint($e, $G, $a, $b, $p));
    $sR = mulPoint($s, $Rpt, $a, $b, $p);
    $sR_plus_eGNeg = addPoints($sR, $eGNeg, $a, $p);
    $Q = mulPoint($rInv, $sR_plus_eGNeg, $a, $b, $p);

    $pubKey = [
        'x' => str_pad(gmp_strval($Q['x'], 16), 64, '0', STR_PAD_LEFT),
        'y' => str_pad(gmp_strval($Q['y'], 16), 64, '0', STR_PAD_LEFT)
    ];

    return $pubKey;
}
function negatePoint($point)
{
    return array('x' => $point['x'], 'y' => gmp_neg($point['y']));
}
function mulPoint($k, array $pG, $a, $b, $p, $base = null)
{
    if ($base === 16 || $base === null || is_resource($base)) {
        $k = gmp_init($k, 16);
    } elseif ($base === 10) {
        $k = gmp_init($k, 10);
    }

    $kBin = gmp_strval($k, 2);

    $lastPoint = $pG;

    for ($i = 1, $length = strlen($kBin); $i < $length; $i++) {
        $lastPoint = doublePoint($lastPoint, $a, $p);

        if ($kBin[$i] === '1') {
            $lastPoint = addPoints($lastPoint, $pG, $a, $p);
        }
    }

    if (!validatePoint(gmp_strval($lastPoint['x'], 16), gmp_strval($lastPoint['y'], 16), $a, $b, $p)) {
        throw new \Exception('The resulting point is not on the curve.');
    }

    return $lastPoint;
}
function doublePoint(array $pt, $a, $p)
{
    $twoY = gmp_mod(gmp_mul(gmp_init(2, 10), $pt['y']), $p);

    $gcd = gmp_strval(gmp_gcd($twoY, $p));
    if ($gcd !== '1') {
        throw new \Exception('This library doesn\'t yet support point at infinity. See https://github.com/BitcoinPHP/BitcoinECDSA.php/issues/9');
    }

    $threeXSquare = gmp_mul(gmp_init(3, 10), gmp_pow($pt['x'], 2));
    $addThreeXSquareA = gmp_add($threeXSquare, $a);

    $invertModTwoY = gmp_invert($twoY, $p);

    $slope = gmp_mod(gmp_mul($invertModTwoY, $addThreeXSquareA), $p);

    $subSubPow = gmp_sub(gmp_sub(gmp_pow($slope, 2), $pt['x']), $pt['x']);
    $nPt['x'] = gmp_mod($subSubPow, $p);

    $subXMul = gmp_mul($slope, gmp_sub($pt['x'], $nPt['x']));
    $subXMulSubY = gmp_sub($subXMul, $pt['y']);
    $nPt['y'] = gmp_mod($subXMulSubY, $p);

    return $nPt;
}
function validatePoint($x, $y, $a, $b, $p)
{
    $x = gmp_init($x, 16);
    $y2Expected = gmp_mod(gmp_add(gmp_add(gmp_powm($x, gmp_init(3, 10), $p), gmp_mul($a, $x)), $b), $p);
    $y2Actual = gmp_mod(gmp_pow(gmp_init($y, 16), 2), $p);

    return gmp_cmp($y2Expected, $y2Actual) === 0;
}
function addPoints(array $pt1, array $pt2, $a, $p)
{
    if (gmp_cmp($pt1['x'], $pt2['x']) === 0 && gmp_cmp($pt1['y'], $pt2['y']) === 0) {
        return doublePoint($pt1, $a, $p);
    }

    $deltaX = gmp_sub($pt1['x'], $pt2['x']);
    $deltaY = gmp_sub($pt1['y'], $pt2['y']);
    $gcd = gmp_strval(gmp_gcd($deltaX, $p));

    if ($gcd !== '1') {
        throw new \Exception('This library doesn\'t yet support point at infinity. See https://github.com/BitcoinPHP/BitcoinECDSA.php/issues/9');
    }

    $slope = gmp_mod(gmp_mul($deltaY, gmp_invert($deltaX, $p)), $p);

    $nPt = [];
    $nPt['x'] = gmp_mod(gmp_sub(gmp_sub(gmp_pow($slope, 2), $pt1['x']), $pt2['x']), $p);
    $nPt['y'] = gmp_mod(gmp_sub(gmp_mul($slope, gmp_sub($pt1['x'], $nPt['x'])), $pt1['y']), $p);

    return $nPt;
}

function isEvenNumber($number)
{
    $lastDigit = $number[strlen($number) - 1];
    return ($lastDigit % 2) === 0;
}
