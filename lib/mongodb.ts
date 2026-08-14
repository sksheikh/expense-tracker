import { MongoClient } from 'mongodb'
const uri = process.env.MONGODB_URI
if (!uri) console.warn('[v0] MONGODB_URI is not set; API routes will return a configuration error.')
const globalForMongo = globalThis as unknown as { mongo?: { client: MongoClient; promise: Promise<MongoClient> } }
export const mongo = uri ? (globalForMongo.mongo ??= (() => { const client = new MongoClient(uri); return { client, promise: client.connect() } })()) : null
export async function db() { if (!mongo) throw new Error('MONGODB_URI is not configured'); return (await mongo.promise).db(process.env.MONGODB_DB ?? 'expense_tracker') }
