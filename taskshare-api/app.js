const express = require("express");
const mysql = require("mysql2/promise");
const bcrypt = require("bcrypt");
const jwt = require("jsonwebtoken");
const cors = require("cors");

const app = express();
const PORT = 8000;

const paramdb = {
  host: "127.0.0.1",
  user: "root",
  password: "",
  database: "taskshare_db",
};

app.use(express.json());
app.use(cors());

// REGISTER (tidak dipakai sekarang, tapi siap digunakan)
app.post("/user", async (req, res) => {
  const { name, email, password } = req.body;
  const hash = await bcrypt.hash(password, 8);

  try {
    const db = await mysql.createConnection(paramdb);
    const sql = "INSERT INTO user (name, email, password) VALUES (?, ?, ?)";
    await db.execute(sql, [name, email, hash]);
    db.end();

    res.status(200).json({ message: "User created!" });
  } catch (error) {
    res.status(409).json({ error: error.message });
  }
});

// LOGIN
app.post("/auth", async (req, res) => {
  const { email, password } = req.body;

  try {
    const db = await mysql.createConnection(paramdb);
    const [rows] = await db.execute("SELECT * FROM user WHERE email = ?", [
      email,
    ]);
    db.end();

    const user = rows[0];
    if (!user)
      return res.status(404).json({ message: "Email tidak ditemukan." });

    const match = await bcrypt.compare(password, user.password);
    if (!match) return res.status(401).json({ message: "Password salah." });

    const token = jwt.sign(
      { id: user.id, email: user.email },
      "katakuncirahasia",
      { expiresIn: "1h" }
    );

    res.status(200).json({ token });
  } catch (error) {
    res.status(500).json({ error: error.message });
  }
});

// MIDDLEWARE CEK TOKEN
const cekToken = (req, res, next) => {
  const { token } = req.body;
  if (!token)
    return res.status(401).json({ message: "Token tidak ditemukan." });

  try {
    const data = jwt.verify(token, "katakuncirahasia");
    req.body.data = data;
    next();
  } catch (error) {
    res.status(401).json({ message: "Token tidak valid atau kadaluarsa." });
  }
};

// HALAMAN TERLINDUNGI
app.get("/secretPage", cekToken, (req, res) => {
  const { data } = req.body;
  res.status(200).json({ message: `Hello, ${data.email}` });
});

app.listen(PORT, () => {
  console.log(`API berjalan di http://localhost:${PORT}`);
});
