<?php
if (!function_exists('password_verify_compat')) {
    /**
     * Verifica se a senha corresponde ao hash usando uma implementação compatível.
     *
     * @param string $password A senha a ser verificada.
     * @param string $hash     O hash da senha.
     *
     * @return bool Retorna true se a senha corresponder ao hash, caso contrário, false.
     */
    function password_verify_compat($password, $hash) {
        if (!function_exists('password_hash')) {
            throw new Exception('A função password_hash() é necessária.');
        }
        
        // Verifique se o hash precisa ser rehash (compatibilidade com PHP < 5.5)
        if (password_needs_rehash($hash, PASSWORD_DEFAULT)) {
            return false;
        }
        
        return crypt($password, $hash) === $hash;
    }
}
?>
