const express = require('express');
const cors = require('cors');
const mysql = require('mysql2/promise');

const app = express();
app.use(express.json());
app.use(cors());


//Options
const corsOptions = {
  origin: 'http://localhost/cafe/index.html',
  methods: 'GET, PUT, POST, DELETE, PATCH, TRACE',
  optionsSuccessStatus: 200,
};

const dbConfig = {
  host: 'localhost',
  user: 'root',
  password: '',
  database: 'pollo',
};

async function getDbConnection() {
  const connection = await mysql.createConnection(dbConfig);
  return connection;
}


//Get
app.get('/cards', async (req, res) => {
  try {
    const connection = await getDbConnection();
    const [rows, fields] = await connection.execute('SELECT id, name, description, cost FROM card');

    const cards = rows.map((row) => ({
      id: row.id,
      name: row.name,
      description: row.description,
      cost: row.cost,
    }));

    connection.end();

    res.setHeader('Amlo', 'Kemonito');
    
    res.json(cards);
  } catch (error) {
    console.error(`Error de MySQL: ${error}`);
    res.status(500).json({ error: 'Error en la base de datos' });
  }
});

//Post
app.post('/reservaciones', async (req, res) => {
  const { name, email, description } = req.body;
  console.log('Datos recibidos:', name, email, description);
  try {
    const connection = await getDbConnection();
    const [result] = await connection.execute('INSERT INTO reservaciones (name, email, description) VALUES (?, ?, ?)', [name, email, description]);

    const newReservacionId = result.insertId;

    connection.end();
    res.status(201).json({ message: 'Reservación creada con éxito', id: newReservacionId });
  } catch (error) {
    console.error(`Error de MySQL: ${error}`);
    res.status(500).json({ error: 'Error al crear la reservación' });
  }
});

//post para las cards 
app.post('/cards', async (req, res) => {
  const { name, description, cost } = req.body;
  
  // Verificar que los valores no son undefined
  if (name === undefined || description === undefined || cost === undefined) {
    return res.status(400).json({ error: 'Faltan datos en la solicitud' });
  }

  console.log('Datos recibidos:', name, description, cost);
  
  try {
    const connection = await getDbConnection();
    const [result] = await connection.execute('INSERT INTO card (name, description, cost) VALUES (?, ?, ?)', [name, description, cost]);

    const newCardId = result.insertId;

    connection.end();
    res.status(201).json({ message: 'Card creada con éxito', id: newCardId });
  } catch (error) {
    console.error(`Error de MySQL: ${error}`);
    res.status(500).json({ error: 'Error al crear la card' });
  }
});


// Patch
app.patch('/cards/:id', async (req, res) => {
  const cardId = req.params.id;
  const { name, description, cost } = req.body;

  try {
    const connection = await getDbConnection();
    const [result] = await connection.execute('UPDATE card SET name=?, description=?, cost=? WHERE id=?', [name, description, cost, cardId]);

    connection.end();

    if (result.affectedRows === 0) {
      res.status(404).json({ error: 'Tarjeta no encontrada' });
    } else {
      res.json({ message: 'Tarjeta actualizada con éxito' });
    }
  } catch (error) {
    console.error(`Error de MySQL: ${error}`);
    res.status(500).json({ error: 'Error al actualizar la tarjeta' });
  }
});

const port = process.env.PORT || 3000;
app.listen(port, () => {
  console.log(`La aplicación está escuchando en el puerto ${port}`);
});


//Put
app.put('/cards/:id', async (req, res) => {
  const cardId = req.params.id;
  const { name, description, cost } = req.body;

  try {
    const connection = await getDbConnection();
    const [result] = await connection.execute('UPDATE card SET name=?, description=?, cost=? WHERE id=?', [name, description, cost, cardId]);

    connection.end();

    if (result.affectedRows === 0) {
      res.status(404).json({ error: 'Tarjeta no encontrada' });
    } else {
      res.json({ message: 'Tarjeta actualizada con éxito' });
    }
  } catch (error) {
    console.error(`Error de MySQL: ${error}`);
    res.status(500).json({ error: 'Error al actualizar la tarjeta' });
  }
});

//Search
app.get('/search', async (req, res) => {
  const { name } = req.query;

  try {
    const connection = await getDbConnection();
    const [rows, fields] = await connection.execute('SELECT id, name, description, cost FROM card WHERE name LIKE ?', [`%${name}%`]);

    const searchResults = rows.map((row) => ({
      id: row.id,
      name: row.name,
      description: row.description,
      cost: row.cost,
    }));

    connection.end();

    res.json(searchResults);
  } catch (error) {
    console.error(`Error de MySQL: ${error}`);
    res.status(500).json({ error: 'Error en la búsqueda' });
  }
});

//link
app.post('/link', async (req, res) => {
  const { cardId, otherResourceId } = req.body;

  try {
    // Verifica la existencia de los recursos antes de establecer el enlace
    const connection = await getDbConnection();

    // Asegúrate de tener una tabla 'card' en tu base de datos
    const [result] = await connection.execute('INSERT INTO card_link (card_id, other_card_id) VALUES (?, ?)', [cardId, otherResourceId]);

    const linkId = result.insertId;

    connection.end();

    res.status(201).json({ message: 'Enlace creado con éxito', id: linkId });
  } catch (error) {
    console.error(`Error de MySQL: ${error}`);
    res.status(500).json({ error: 'Error al crear el enlace' });
  }
});

//Delete
app.delete('/cards/:id', async (req, res) => {
  const cardId = req.params.id;

  try {
    // Obtén la conexión a la base de datos
    const connection = await getDbConnection();

    // Ejecuta la consulta DELETE en la base de datos
    const [result] = await connection.execute('DELETE FROM card WHERE id = ?', [cardId]);

    // Cierra la conexión
    connection.end();

    // Verifica si se eliminó alguna fila
    if (result.affectedRows === 0) {
      res.status(404).json({ error: 'Tarjeta no encontrada' });
    } else {
      res.json({ message: 'Tarjeta eliminada con éxito' });
    }
  } catch (error) {
    console.error(`Error de MySQL: ${error}`);
    res.status(500).json({ error: 'Error al eliminar la tarjeta' });
  }
});
