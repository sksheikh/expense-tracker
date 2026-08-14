import { NextResponse } from 'next/server'
import { db } from '@/lib/mongodb'
export async function GET() { try { const database=await db(); const expenses=database.collection('expenses'); const rows=await expenses.find({}).sort({date:-1}).limit(20).toArray(); return NextResponse.json({expenses:rows}) } catch (error) { return NextResponse.json({error:'MongoDB Atlas is not configured or unavailable.',details:error instanceof Error?error.message:'Unknown error'},{status:503}) } }
