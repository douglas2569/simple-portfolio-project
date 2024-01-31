import { Injectable } from '@angular/core';
import SendEmail from '../models/SendEmail';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import Response from '../models/Response';
import { environment } from 'src/environments/environment';

@Injectable({
  providedIn: 'root'
})
export class SendEmailService {

  constructor(private http:HttpClient) { }

  send(data:SendEmail):Observable<Response<SendEmail>>{
    const url:string = `${environment.urlApi}/api/email`
    return this.http.post<Response<SendEmail>>(url, data)
  }
}
