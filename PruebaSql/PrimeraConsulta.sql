SELECT
 a.id AS cedula,
  CONCAT_WS( ' ', a.primer_nombre, a.primer_apellido ) nombre,
   a.dias_mora AS diasEnMora,
    ( CASE WHEN a.dias_mora >= 1 AND a.dias_mora <= 20 THEN 'Riesgo Bajo' 
    WHEN a.dias_mora >= 21 AND a.dias_mora <= 35 THEN 'Riesgo Medio' 
    WHEN a.dias_mora > 35 THEN 'Riesgo Alto' END ) AS riesgo,
     b.Nombre AS ciudad FROM cliente a 
     INNER JOIN ciudad b 
     WHERE a.id_ciudad = b.id ORDER BY a.dias_mora ASC;