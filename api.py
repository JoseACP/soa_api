from fastapi import FastAPI, HTTPException
from fastapi.middleware.cors import CORSMiddleware
import pymysql

app = FastAPI()

# Enable CORS
app.add_middleware(
    CORSMiddleware,
    allow_origins=["http://localhost/cafe/index.html"],
    allow_credentials=True,
    allow_methods=["GET", "PUT", "POST", "DELETE", "PATCH", "TRACE"],
    allow_headers=["*"],
)

# Database configuration
db_config = {
    "host": "localhost",
    "user": "root",
    "password": "",
    "database": "csv-database",
}

# Function to get a database connection
async def get_db_connection():
    connection = pymysql.connect(**db_config)
    return connection

# Get
@app.get("/cards")
async def read_cards():
    try:
        connection = await get_db_connection()
        with connection.cursor() as cursor:
            cursor.execute("SELECT cve_municipio, desc_municipio, año, valor FROM motors")
            rows = cursor.fetchall()

        cards = [
            {"cve_municipio": row[0], "desc_municipio": row[1], "año": row[2], "valor": row[3]}
            for row in rows
        ]

        connection.close()
        return cards
    except Exception as e:
        raise HTTPException(status_code=500, detail=f"Database Error: {str(e)}")


if __name__ == "__main__":
    import uvicorn

    uvicorn.run(app, host="127.0.0.1", port=3000)
