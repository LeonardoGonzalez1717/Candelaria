select e.nombre_completo, e.cedula, s.seccion, c.curso, m.mencion from estudiantes e
left join seccion s on e.id_seccion=s.id
left join curso c on e.id_curso = c.id
left join mencion m on e.id_mencion = m.id;

UPDATE cursando join alumno on cursando.id_alumno = alumno.id set SET alumno.nombre = 'leo', alumno.apellido = 'gonzalez', alumno.cedula = '8487451', alumno.edad = '30'  cursando.id_alumno = '3' cursando.id_ano = '2' periodo = '2022/2023' where alumno.id= 3; 

select * from alumno where id not in(select * from notas);