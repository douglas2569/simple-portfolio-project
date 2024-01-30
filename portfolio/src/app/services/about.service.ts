import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import About from '../models/About';
import { environment } from 'src/environments/environment';

@Injectable({
  providedIn: 'root'
})
export class AboutService {
  userEmail:string = 'root@gmail.com'
  URL:string = `${environment.urlApi}/${this.userEmail}/about`

  constructor(private http:HttpClient) { }

  getAbout():Observable<About>{
    return this.http.get<About>(this.URL)
  }

}
