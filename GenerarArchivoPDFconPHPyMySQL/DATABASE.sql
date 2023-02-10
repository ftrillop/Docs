
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";



CREATE TABLE `transacciones` (
  `id` int(11) NOT NULL,
  `transaccion_cod` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombres` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo_pago` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado_transaccion` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


INSERT INTO `transacciones` (`id`, `transaccion_cod`, `nombres`, `tipo_pago`, `estado_transaccion`, `email`) VALUES
(1, '10001', 'Jose Flores', 'Tarjeta', 'Activo', 'jose@gmail.com');


ALTER TABLE `transacciones`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `transacciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

