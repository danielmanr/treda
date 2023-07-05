SELECT
	p.CC,
    p.Nombre,
    estudios.Institucion,
    maxfechas.fecha
FROM
    (
    SELECT
        FKPersona,
        MAX(fecha) as fecha
    FROM
        estudios
    GROUP BY
        fkpersona
) AS maxfechas
INNER JOIN estudios ON maxfechas.FKPersona = estudios.FKPersona AND maxfechas.fecha = estudios.fecha
INNER JOIN persona p ON p.CC = estudios.FKPersona;